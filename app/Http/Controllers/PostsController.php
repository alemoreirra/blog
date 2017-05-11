<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostFormRequest;

class PostsController extends Controller {

    private $post = null;
    private $totalPage = 3;

    public function __construct(Post $post) {
        $this->post = $post;
    }

    public function index() {
        $title = 'Listagem de Posts';
        $posts = $this->post->paginate($this->totalPage);
        return view('posts.index', compact('posts', 'title'));
    }

    public function create() {
        $title = 'Cadastrar novo post';
        return view('posts.form', compact('title'));
    }

    public function edit($id) {
        $post = $this->post->find($id);
        $title = 'Editar Post: ' . $post->title;
        return view('posts.form', compact('post', 'title'));
    }

    public function store(PostFormRequest $request) {
        $dataForm = $request->except(['_token']);
        $insert = $this->post->create($dataForm);
        if ($insert) {
            return redirect()->route('posts.index');
        }
        return redirect()->back();
    }

    public function update(PostFormRequest $request, $id) {
        $post = $this->post->find($id);
        $dataForm = $request->except('_token');
        $update = $post->update($dataForm);
        if ($update) {
            return redirect()->route('posts.index');
        }
        return redirect()->route('posts.edit', $id)->with(['errors' => 'Falha ao Editar']);
    }

    public function show($id) {
        $post = $this->post->find($id);
        //$title = 'visualizar: '.$post->title;
        return view('posts.show', compact('post'));
    }
    
    public function destroy($id)
    {
        $post = $this->post->find($id);
        $delete = $post->delete();
        if ($delete) {
            return redirect()->route('posts.index');
        }
        return redirect()->route('posts.show', $id)->with(['errors' => 'Falha ao remover o post']);
    }

}
