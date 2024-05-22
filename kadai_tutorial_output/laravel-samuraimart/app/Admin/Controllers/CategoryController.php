<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\MajorCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'));
        $grid->column('description', __('Description'));
        $grid->column('major_category_id', __('Major category name'))->editable('select', MajorCategory::all()->pluck('name', 'id'));
        $grid->column('image', __('Image'))->image();
        $grid->column('created_at', __('Created at'))->sortable();
        $grid->column('updated_at', __('Updated at'))->sortable();

        $grid->filter(function($filter) {
            $filter->like('name', 'カテゴリー名');
            $filter->in('major_category_id', '親カテゴリー名')->multipleSelect(MajorCategory::all()->pluck('name', 'id'));
            $filter->between('created_at', '登録日')->datetime();
        });
        
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
        $show->field('major_category.name', __('Major category name'));
        $show->field('image', __('Image'))->image();
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));
        $form->select('major_category_id', __('Major Category Name'))->options(MajorCategory::all()->pluck('name', 'id'));

        return $form;
    }
}
