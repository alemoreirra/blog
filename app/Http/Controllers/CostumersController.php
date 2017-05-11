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
    public function index() {
        $costumers = $this->costumer->paginate($this->totalPage);
        $title = 'Listagem de Clientes';
        return view('costumers.index', compact('title', 'costumers'));
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
        //
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $costumer = $this->costumer->find($id);
        $title = 'Editar cliente: ' . $costumer->name;
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
        //
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
