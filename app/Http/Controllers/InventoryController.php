<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InventoryController extends Controller
{
    //Global Inventory Functions
    
    // Lets you view all (or specific types) of global inventory. Paramter can be a type from inventory table (i.e. Whiskey). If no type is entered shows all.
    public function viewAll($type = null) {
      if($type == null){
        $inventory = \App\Inventory::paginate(9);
        return view('inventory.view_all', compact('inventory'));
      }
      else {
        $inventory = \App\Inventory::where('type', 'like', '%' . $type . '%')->paginate(9);
        return view('inventory.view_all', compact('inventory'));
      }
    }

    //Gets details of specfic items in global inventory. Takes the ID of the item from the Inventory table
    public function getDetails($id) {
        $inventory = \App\Inventory::find($id);
        return view('inventory.inventory_detail', compact('inventory'));
    }

    //Returns view to add item to global inventory
    public function addInventory() {
        return view('inventory.add_inventory');
    }    
    
    //Saves item to global inventory. Request comes from form in 'inventory.add_inventory' view. Should include name, brand, type, (optional) picture, and a set of prices (mini, hp, pint, fifth, liter, hg), that is sent to a function in the inventory model that saves it as json.
    public function saveInventory(Request $request) {
        $this->validate($request, [
            'picture' => 'image',
            'name' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'mini_price' => 'numeric',
            'hp_price' => 'numberic',
            'pint_price' => 'numeric',
            'fifth_price' => 'numeric',
            'liter_price' => 'numeric',
            'hg_price' => 'numeric'
            
        ]);
        $newInventory = new \App\Inventory;
        $newInventory->name = $request->name;
        $newInventory->brand = $request->brand;
        $newInventory->type = $request->type;
        $newInventory->setPrice($request->mini_price, $request->hp_price, $request->pint_price, $request->fifth_price, $request->liter_price, $request->hg_price);
        $newInventory->save();
        if ($request->hasFile('picture')) {
            $newInventory->picture = 1;
            $destinationPath = 'inventory/images';
            $request->file('picture')->move($destinationPath, $newInventory->id);
            $newInventory->save();
        }
        else {
           $newInventory->picture = 0;
        }
        return view('home');
    }
    
    //Updates global inventory item. Request comes from ajax function on inventory detail view page.
    public function updateInventory( Request $request, $id) {
        if ($request->ajax()){
            $item = \App\Inventory::find($id);
            $item->name = $request->name;
            $item->brand = $request->brand;
            $item->setPrice($request->mini_price, $request->hp_price, $request->pint_price, $request->fifth_price, $request->liter_price, $request->hg_price);
            $item->save();
            return $item;
       }
    }
    
    //Deletes global inventory item. Uses inventory id ($id) to delete item from inventory table
    public function deleteInventory($id) {
        \App\Inventory::destroy($id);
        return redirect('inventory/view_all');
    }
    
    //User Inventory functions
    //Returns user inventory view. $id = user's id to grab all items ($user->inventory collection) from UserInventory pivot table.
    public function viewUser($id) {
        $user = \App\User::find($id);
        $drinks = $user->inventory;
        return view('inventory.user_inventory', compact('drinks'));
    }

    //Deletes item from user's inventory. Ajax request from user's personal inventory view that takes just the url from the AJAX call that contains the UserInventory_ID to delete the item. Returns string "success".
    public function deletePersonal(Request $request, $id) {
        if ($request->ajax()){
            \App\UserInventory::destroy($id);
            return "success";
        }
    }

    //Returns view to add item from global inventory to user's inventory. $id = inventory_id of item to be added.
    public function addPersonal($id) {
        $drink = \App\Inventory::find($id);
        return view('inventory/add_personal')->with(compact('drink'));
    }

    //updates item from user's inventory. Sent via ajax from user inventory page. $id = UserInventory ID of item to be updated. Request has price, size, and in_stcok. Response is sent back to ensure proper items in view.
    public function updatePersonal(Request $request, $id) {
        if ($request->ajax()){
            $item = \App\UserInventory::find($id);
            $item->price = $request->price;
            $item->size = $request->size;
            $item->in_stock = $request->in_stock;
            $item->save();
            return response()->json(['price' => $item->price, 'size' => $item->size, 'in_stock' => $item->in_stock]);
        }
    }

    //Saves global inventory itme from addPersonal function to user's inventory. Adds teh inventory ID, then the size, price, and instock to  pivot table. Attached to current logged in user's ID. Returns user to User's inventory view via redirect.
    public function savePersonal(Request $request, $id) {
        $user = \Auth::user();
        if(empty($request->in_stock)) {
           $instock = 0;
        }
        else {
           $instock = 1;
        }
        $user->inventory()->attach($id, ['size' => $request->size, 'price' => $request->price, 'in_stock' => $instock]);
        return redirect('inventory/user/'. \Auth::user()->id);
    }
}
