<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AuthorRequest;
use App\Models\Admin\Author;
use App\Models\Admin\Book;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;

/**
 * Class AuthorController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AuthorController extends CrudController
{
    use ListOperation,
        ShowOperation,
        CreateOperation,
        UpdateOperation,
        DeleteOperation;

    /**
     *
     * @throws \Exception
     */
    public function setup(): void
    {
        /* need model */
        $this->crud->setModel(Author::class);
        /* admin/authors */
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/authors');
        /* 'Единственное числ.', 'Множественное чл.' */
        $this->crud->setEntityNameStrings(
            trans_choice('messages.authors', 1),
            trans_choice('messages.authors', 2)
        );
        /**
         * List
         */
        $this->crud->operation('list', function () {
            $this->crud->addColumns([
                ['name' => 'name', 'type' => 'text', 'label' => __('messages.author_label')],
                ['name' => 'created_at', 'type' => 'date', 'label' => __('messages.created_at')],
            ]);
        });
        /**
         * Show
         */
        $this->crud->operation('show', function () {
            $this->crud->addColumns([
                ['name' => 'name', 'type' => 'text', 'label' => __('messages.author_label')],
                [
                    'name'      => 'books',
                    'type'      => 'select_multiple',
                    'label'     => __('messages.books_label'),
                    'entity'    => 'books',
                    'attribute' => 'name',
                    'pivot'     => true,
                ],
                ['name' => 'created_at', 'type' => 'date', 'label' => __('messages.created_at')],
                ['name' => 'updated_at', 'type' => 'date', 'label' => __('messages.updated_at')],
            ]);
        });
        /**
         * Create|Update
         */
        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(AuthorRequest::class);
            $this->crud->addFields([[
                                        'name'       => 'name',
                                        'label'      => __('messages.author_label'),
                                        'attributes' => [
                                            'placeholder' => __('messages.author_label'),
                                        ],
                                    ],
                                    [
                                        'label'      => __('messages.books_label'),
                                        'type'       => 'select2_multiple',
                                        'name'       => 'books',
                                        'entity'     => 'books',
                                        'attribute'  => 'name',
                                        'pivot'      => true,
                                        'model'      => Book::class,
                                        'attributes' => [
                                            'placeholder' => __('messages.books_label'),
                                        ],
                                    ],
            ]);
        });
    }

    /**
     *
     */
    protected function setupListOperation(): void
    {
        //
    }

    /**
     *
     */
    protected function setupCreateOperation(): void
    {
        //
    }

    /**
     *
     */
    protected function setupUpdateOperation(): void
    {
        //
    }

}
