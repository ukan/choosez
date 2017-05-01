<?php

namespace App\Http\Controllers\Backend\Admin\LcwPage;

//use App\Models\Menu;
use App\Http\Controllers\Backend\Admin\BaseController;

class LcwCategorysController extends BaseController
{
    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * Datatables for Menu Management.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatables()
    {

    }

    /**
     * Handle create and edit method.
     *
     * @param  array  $datatoBind
     * @param  int    $id
     * @return \Illuminate\Http\Response
     */
    protected function createEdit($dataToBind, $id = 0)
    {

    }

    /**
     * Handle store and update method.
     *
     * @param  \App\Http\Requests\Backend\UserTrustee\MenuRequest $request
     * @param  int                                          $id
     * @return \Illuminate\Http\Response
     */
    private function storeUpdate(Request $request, $id = 0)
    {

    }
}
