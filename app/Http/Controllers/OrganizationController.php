<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\Account;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function index()
    {
        $organizations = Organization::all();
        return view('organization/index', ['organizations' => $organizations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organization/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $organization = new Organization;
        $organization->name = $input['name'];
        $organization->save();

        if (!is_null($input['email1'])) {
            $account = new Account(['email' => $input['email1'], 'password' => $input['password1']]);
            $organization->accounts()->save($account);
        }
        if (!is_null($input['email2'])) {
            $account = new Account(['email' => $input['email2'], 'password' => $input['password2']]);
            $organization->accounts()->save($account);
        }
        if (!is_null($input['email3'])) {
            $account = new Account(['email' => $input['email3'], 'password' => $input['password3']]);
            $organization->accounts()->save($account);
        }

        return redirect(route('organization.index'));
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
        $organization = Organization::find($id);
        return view('organization/edit', ['organization' => $organization]);
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
        $input = $request->all();
        $organization = Organization::find($id);
        $organization->name = $input['name'];
        $organization->save();

        if (!is_null($input['email1']) && !is_null($input['password1'])) {
            $account = new Account(['email' => $input['email1'], 'password' => $input['password1']]);
            $organization->accounts()->save($account);
        }
        if (!is_null($input['email2']) && !is_null($input['password2'])) {
            $account = new Account(['email' => $input['email2'], 'password' => $input['password2']]);
            $organization->accounts()->save($account);
        }
        if (!is_null($input['email3']) && !is_null($input['password3'])) {
            $account = new Account(['email' => $input['email3'], 'password' => $input['password3']]);
            $organization->accounts()->save($account);
        }

        return redirect(route('organization.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
