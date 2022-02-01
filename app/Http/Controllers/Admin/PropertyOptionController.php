<?php

namespace App\Http\Controllers\Admin;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\PropertyOption;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyOptionRequest;

class PropertyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Property  $property
     * @return \Illuminate\Http\Response
     */
    public function index(Property $property)
    {
        $propertyOptions = $property->propertyOptions()->paginate(10);
        //dd($property);

        return view('admin.property_options.index', compact('propertyOptions', 'property'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Property  $property
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        return view('admin.property_options.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PropertyOptionRequest  $request
     * @param  Property  $property
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyOptionRequest $request, Property $property)
    {
        $params = $request->all();
        $params['property_id'] = $request->property->id;

        PropertyOption::create($params);
        return redirect()->route('property-options.index', $property)->with('success','Вариант свойства добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyOption $propertyOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Property  $property
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property, PropertyOption $propertyOption)
    {
        return view('admin.property_options.edit', compact('propertyOption', 'property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Property  $property
     * @param  PropertyOptionRequest  $request
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyOptionRequest $request, Property $property, PropertyOption $propertyOption)
    {
        $params = $request->all();

        $propertyOption->update($params);
        return redirect()->route('property-options.index', $property)->with('success','Вариант свойства был успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Property  $property
     * @param  \App\Models\PropertyOption  $propertyOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property, PropertyOption $propertyOption)
    {
        $propertyOption->delete();

        return redirect()->route('property-options.index', $property)->with('success','Вариант свойства был успешно удален!');
    }
}
