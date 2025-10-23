<?php

namespace App\Http\Controllers;
use App\ExpenseHead;
use App\Expense;
use App\ExpenseCategory;
use Auth;
use PDF;
use Illuminate\Support\Carbon;
use Session;

use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    // get all list
    public function index()
    {
        $expensesCategory=ExpenseCategory::all();
        return view('admin.expenseCategory.expenseCategoryList', compact('expensesCategory'));
    }

    // add expense category 
    public function create()
    {
        $expense_heads=ExpenseHead::all();
        return view('admin.expenseCategory.addExpenseCategory', compact('expense_heads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            
            
            'name' => 'required',
            
        ]);

        $admin=Auth::guard('admin')->user();

        $expense=new ExpenseCategory;

        $expense->expense_head_id=$admin->id;
        $expense->name=$request->name;
        $expense->save();

        $request->session()->flash('success', 'Expense Category Added Successfully');
        return redirect('admin/expenseCategory/');
    }

    public function edit($id)
    {
        $expenseCategory=ExpenseCategory::find($id);
        $expense_heads=ExpenseHead::all();
        return view('admin.expenseCategory.editExpenseCategory', compact('expenseCategory', 'expense_heads'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            
            // 'expense_head_id' => 'required',
            'name' => 'required',
            
        ]);

        $expense=ExpenseCategory::find($id);

        $expense->name=$request->name;
        $expense->save();

        $request->session()->flash('success', 'Expense Category Updated Successfully');
        return redirect('admin/expensesCategory/');
    }
}
