<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Costumer;
use Illuminate\Support\Facades\Input;

class CostumersController extends Controller {

    private $costumer = null;
    private $totalPage = 3;

    /**
     * 
     * @param Costumer $costumer
     */
    public function __construct(Costumer $costumer) {
        $this->costumer = $costumer;
    }

    /**
     * 
     * @return type
     */
    public function index(Request $request) {

        $title = 'Listagem de Clientes';
        $imagePath = '/storage/costumer';
        $costumers = null;
        $where = [];
        if (!empty($request->all())) {
            if (!empty($request->name)) {
                array_push($where, ['name', 'like', '%' . $request->name . '%']);
            }
            if (!empty($request->last_name)) {
                array_push($where, ['last_name', 'like', '%' . $request->last_name . '%']);
            }
            if (!empty($request->email)) {
                array_push($where, ['email', 'like', '%' . $request->email . '%']);
            }
            if ($request->active != '') {
                array_push($where, ['active', $request->active . '%']);
            }
        }
        $costumers = $this->costumer->where($where)->paginate($this->totalPage);
        return view('costumers.index', compact('title', 'costumers', 'imagePath'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $title = 'Cadastrar cliente';
        return view('costumers.form', compact('title'));
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $dataForm = $request->except(['_token']);
        $dataForm['active'] = (Input::has('active'));
        $insert = $this->costumer->create($dataForm);
        if ($insert) {
            return redirect()->route('costumers.index');
        }
        return redirect()->back();
    }

    /**
     * 
     * @param type $id
     */
    public function show($id) {
        $costumer = $this->costumer->find($id);
        $costumer->image = !empty($costumer->image) ? $costumer->image : 'default.png';
        $imagePath = '/storage/costumer/' . $costumer->image;
        return view('costumers.show', compact('costumer', 'imagePath'));
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $costumer = $this->costumer->find($id);
        $costumer->active = ($costumer->active == 1);
        $title = 'Editar cliente: ' . $costumer->name;
        $costumer->image = !empty($costumer->image) ? $costumer->image : 'default.png';
        $imagePath = '/storage/costumer/' . $costumer->image;
        return view('costumers.form', compact('costumer', 'title', 'imagePath'));
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function update(Request $request, $id) {
        $costumer = $this->costumer->find($id);
        $dataForm = $request->except('_token');
        $dataForm['active'] = isset($dataForm['active']) ? 1 : 0;
        if (isset($dataForm['image'])) {
            $imageUploadedInfo = $this->uploadImage($request, $id);
            $dataForm['image'] = $imageUploadedInfo['name'];
        }
        $update = $costumer->update($dataForm);
        if ($update) {
            return redirect()->route('costumers.index');
        }
        return redirect()->route('costumers.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $costumer = $this->costumer->find($id);
        $delete = $costumer->delete();
        if ($delete) {
            return redirect()->route('costumers.index');
        }
    }

    /**
     * 
     * @param type $request
     * @param type $costumerId
     * @return type
     */
    private function uploadImage($request, $costumerId) {
        $newFilename = 'image_' . $costumerId . '.' . $request->file('image')->extension();
        $path = $request->file('image')->storeAs(
                'public/costumer', $newFilename
        );
        return ['path' => $path, 'name' => $newFilename];
    }

}
