<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Organization;
use App\Account;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $organizations = Organization::paginate(4);
        return view('admin.organization.index', ['organizations' => $organizations]);
    }
    
    public function search(Request $request)
    {
        $input = $request->all();
        
        $organization = Organization::query();
        if (!empty($input['keyword']))
        {
            $organization->where('name', 'like', '%' . $input['keyword'] . '%');
        }
        
        return view('admin.organization.index', ['organizations' => $organization->paginate(4)]);
    }

    public function create()
    {
        return view('admin.organization.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    protected function validator(array $data)
    {
        $result = [];
        return Validator::make($data, [
            'name' => 'required|string|min:6|max:255',
            'emails.*' => 'email|nullable|distinct',
            'emails.0' => 'required|email',
            'passwords.*' => 'string|min:6|nullable',
            'passwords.0' => 'required',
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->validator($input)->validate();
       //Create seller
        $organization = new Organization;
        $organization->name = $input['name'];
        $organization->save();

        $i = 0;
        foreach ($input['emails'] as $email) {
            if ($i == 0)
            {
                $user = new User(['email' => $input['emails'][$i], 'password' => bcrypt($input['passwords'][$i])]);
                $user->save();
                $i ++;
            }
            $account = new Account(['email' => $email, 'password' => $input['passwords'][$i]]);
            $organization->accounts()->save($account);
        }

        return redirect(route('admin.organization.index'));
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
        return view('admin.organization.edit', ['organization' => $organization]);
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

        return redirect(route('admin.organization.index'));
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
