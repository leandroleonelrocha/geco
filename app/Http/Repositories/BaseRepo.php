<?php
/**
 * Created by PhpStorm.
 * User: llrocha
 * Date: 18/04/2016
 * Time: 13:45
 */

namespace App\Http\Repositories;

abstract class BaseRepo {

    protected $model;
    protected $filial;

    public function __construct()
    {
        $this->model = $this->getModel();
        $this->filial = session('usuario')['entidad_id'];
    }

    public abstract function getModel();

    public function listPaginate()
    {
        return $this->model->orderBy('id', 'DESC')->Paginate(10);
    }

    public function all()
    {
        //slect * from filial;
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($datos)
    {
        return $this->model->create($datos);
    }

    public function edit($model, $datos)
    {
        $model->fill($datos);
        $model->save();

        return $model;
    }

    public function lists($data, $id)
    {
        return $this->model->lists($data, $id);
    }

   
    public function baseWhere($campo,$valor,$inicio,$fin){
    
        return $this->model->where('filial_id', $this->filial)->where($campo,$valor)->whereDate('created_at', '>=', $inicio)->whereDate('created_at','<=', $fin)->get()->count();
    }
}