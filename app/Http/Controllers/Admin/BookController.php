<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BookRequest;
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
 * Class BookController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BookController extends CrudController
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
        $this->crud->setModel(Book::class);
        /* admin/books */
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/books');
        /* 'Единственное числ.', 'Множественное чл.' */
        $this->crud->setEntityNameStrings(
            trans_choice('messages.books', 1),
            trans_choice('messages.books', 2)
        );
        /**
         * List
         */
        $this->crud->operation('list', function () {
            $this->crud->addColumns([
                    ['name' => 'name', 'type' => 'text', 'label' => __('messages.book_label')],
                    ['name' => 'created_at', 'type' => 'date', 'label' => __('messages.created_at')],
                ]
            );
        });
        /**
         * Show
         */
        $this->crud->operation('show', function () {
            $this->crud->addColumns([
                ['name' => 'name', 'type' => 'text', 'label' => __('messages.book_label')],
                [
                    'name'     => 'price',
                    'type'     => 'closure',
                    'label'    => __('messages.price_label'),
                    'function' => static function ($entry) {
                        return numberFormat($entry->price);
                    },
                ],
                [
                    'name'      => 'authors',
                    'type'      => 'select_multiple',
                    'label'     => __('messages.authors_label'),
                    'entity'    => 'authors',
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
            $this->crud->setValidation(BookRequest::class);
            $this->crud->addFields([[
                                        'name'       => 'name',
                                        'label'      => __('messages.book_label'),
                                        'type'       => 'text',
                                        'attributes' => [
                                            'placeholder' => __('messages.book_label'),
                                        ],
                                    ],
                                    [
                                        'name'       => 'price',
                                        'label'      => __('messages.price_label'),
                                        'type'       => 'number',
                                        'attributes' => [
                                            'placeholder' => __('messages.price_label'),
                                            'step'        => 'any' // or 0.01
                                        ],
                                        'prefix'     => '₽',
                                        'suffix'     => '.00',
                                    ],
                                    [
                                        'label'      => __('messages.authors_label'),
                                        'type'       => 'select2_multiple',
                                        'name'       => 'authors',
                                        'entity'     => 'authors',
                                        'attribute'  => 'name',
                                        'pivot'      => true,
                                        'model'      => Author::class,
                                        'attributes' => [
                                            'placeholder' => __('messages.authors_label'),
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
