<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Organization;
use App\Submission;
use App\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $querySubmission = Submission::query();
        $querySubmission->where('organization_id', Account::where('email', Auth::user()->email)->get()[0]->organization_id);
        
        return view('submission/index', ['submissions' => $querySubmission->paginate(5)]);
    }

    public function search(Request $request)
    {
        $input = $request->all();
        
        $querySubmission = Submission::with('organization');
        if (!empty($input['year']))
        {
            $querySubmission->where('year', $input['year']);
        }
        if (!empty($input['month']))
        {
            $querySubmission->where('month', $input['month']);
        }
        if (!empty($input['keyword']))
        {
            $querySubmission->whereHas('organization', function($query) use ($input){
                return $query->where('name', 'like', '%' . $input['keyword'] . '%');
            });
        }
        $querySubmission->orderBy('organization_id');
        
        return view('submission/index', [
                                        'submissions' => $querySubmission->paginate(5),
                                        ]);
    }


    public function create()
    {
        $organization = Account::where('email', Auth::user()->email)->get()[0]->organization->name;
        return view('submission/create', ['organization' => $organization]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'organization' => 'required',
            'year' => 'required|uniqueYearAndMonth:'.$data['month'].', '.Account::where('email', Auth::user()->email)->get()[0]->organization_id,
            'month' => 'required',
            'file' => 'required',
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $this->validator($input)->validate();
        
        $submission = new Submission;
        $submission->organization_id = Account::where('email', Auth::user()->email)->get()[0]->organization_id;
        $submission->year = $input['year'];
        $submission->month = $input['month'];
        $submission->status = "Submitted";
        $submission->file = $request->file('file')->store('files');
        $submission->save();
        return redirect(route('submission.index'));
    }


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
        $submission = Submission::find($id);
        $organization = Account::where('email', Auth::user()->email)->get()[0]->organization->name;
        return view('submission/edit', ['organizations' => $organizations, 'submission' => $submission]);
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
        //
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
