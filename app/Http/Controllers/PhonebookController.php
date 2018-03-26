<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhonebookRequest;
use App\LaraVue\Notifier;
use App\Phonebook;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    protected $pb, $response = [], $alert;
    public function __construct(Phonebook $phonebook, Notifier $alert)
    {
        $this->pb = $phonebook;
        $this->alert = $alert;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PhonebookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhonebookRequest $request)
    {
        $pb = $this->pb::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        $this->response['message'] = 'Error occured. Phonebook not saved';
        $this->response['status'] = false;

        if ($pb) {
            $this->response['message'] = 'New phonebook created';
            $this->response['status'] = true;
            $this->response['newItem'] = $pb;

        }

        //$this->alert::show('Laravue Message', $this->response['message']);

        return response($this->response);
    }

    public function getData(Request $request)
    {
        $books = $this->pb::orderBy('name', 'asc')->paginate($request->perPage);

        return response()->json($books);
    }

    /**
     * Filter search query
     * This will match names, email and phone number to the query
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSearch(Request $request)
    {
        $searchValue = $request->searchQuery;
        $perPage = $request->perPage;

        $books = $this->pb::orderBy('name', 'asc')
            ->where("name", 'LIKE', "%$searchValue%")
            ->orWhere("email", 'LIKE', "%$searchValue%")
            ->orWhere("phone", 'LIKE', "%$searchValue%")
            ->paginate($perPage);

        return response()->json($books);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(phonebook $phonebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit(phonebook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PhonebookRequest  $request
     * @param  \App\phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(PhonebookRequest $request, Phonebook $phonebook)
    {
        $pb = Phonebook::find($phonebook->id);
        $pb->name = $request->name;
        $pb->email = $request->email;
        $pb->phone = $request->phone;

        $this->response['message'] = $pb;
        $this->response['status'] = false;

        if ($pb->save()) {
            $this->response['message'] = "{$pb->name}'s details updated succesfully.";
            $this->response['status'] = true;
            $this->response['newItem'] = $pb;
        }

        //$this->alert::show('Laravue Message', $this->response['message']);

        return response($this->response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phonebook $phonebook)
    {
        $pb = $this->pb::find($phonebook->id);
        $this->response['message'] = "{$pb->name}'s details deleted successfully.";
        $this->response['deletedItem'] = $pb;

        //$this->alert::show('Laravue Message', $this->response['message']);

        $this->pb::where('id', $phonebook->id)->delete();

        return response($this->response);
    }

}
