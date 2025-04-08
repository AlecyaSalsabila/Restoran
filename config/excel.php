<?php

use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

return [
    'exports' => [
        /*
        |--------------------------------------------------------------------------
        | Chunk Size
        |--------------------------------------------------------------------------
        |
        | When using FromQuery, the query is automatically chunked.
        | Here you can specify how big the chunk should be.
        |
        */
        'chunk_size'             => 1000,

        /*
        |--------------------------------------------------------------------------
        | Pre-calculate formulas during export
        |--------------------------------------------------------------------------
        |
        | By default, formulas are not pre-calculated while exporting. If you
        | want them to be calculated during the export, you can enable this.
        |
        */
        'pre_calculate_formulas' => false,

        /*
        |--------------------------------------------------------------------------
        | Enable strict null comparison
        |--------------------------------------------------------------------------
        |
        | When enabling strict null comparison empty cells ('') will be
        | added to the sheet.
        |
        */
        'strict_null_comparison' => false,

        /*
        |--------------------------------------------------------------------------
        | CSV Settings
        |--------------------------------------------------------------------------
        |
        | Configure delimiter, enclosure, and line endings for CSV exports.
        |
        */
        'csv' => [
            'delimiter'              => ',',
            'enclosure'              => '"',
            'line_ending'            => PHP_EOL,
            'use_bom'                => false,
            'include_separator_line' => false,
            'excel_compatibility'    => false,
            'output_encoding'        => '',
            'test_auto_detect'       => true,
        ],

        /*
        |--------------------------------------------------------------------------
        | Worksheet Properties
        |--------------------------------------------------------------------------
        |
        | Configure worksheet properties like title, creator, description, etc.
        |
        */
        'properties' => [
            'creator'        => '',
            'lastModifiedBy' => '',
            'title'          => '',
            'description'    => '',
            'subject'        => '',
            'keywords'       => '',
            'category'       => '',
            'manager'        => '',
            'company'        => '',
        ],
    ],

    'imports' => [
        /*
        |--------------------------------------------------------------------------
        | Read Only
        |--------------------------------------------------------------------------
        |
        | When set to true, it reads the data from the sheet only without styles.
        |
        */
        'read_only' => true,

        /*
        |--------------------------------------------------------------------------
        | Ignore Empty
        |--------------------------------------------------------------------------
        |
        | If set to true, empty rows will be ignored during the import process.
        |
        */
        'ignore_empty' => false,

        /*
        |--------------------------------------------------------------------------
        | Heading Row Formatter
        |--------------------------------------------------------------------------
        |
        | Configure how the heading row should be formatted.
        | Available options: none|slug|custom
        |
        */
        'heading_row' => [
            'formatter' => 'slug',
        ],

        /*
        |--------------------------------------------------------------------------
        | CSV Settings
        |--------------------------------------------------------------------------
        |
        | Configure delimiter, enclosure, escape character, and input encoding
        | for CSV imports.
        |
        */
        'csv' => [
            'delimiter'        => null,
            'enclosure'        => '"',
            'escape_character' => '\\',
            'contiguous'       => false,
            'input_encoding'   => Csv::GUESS_ENCODING,
        ],

        /*
        |--------------------------------------------------------------------------
        | Worksheet Properties
        |--------------------------------------------------------------------------
        |
        | Configure properties like creator, title, description for the imported file.
        |
        */
        'properties' => [
            'creator'        => '',
            'lastModifiedBy' => '',
            'title'          => '',
            'description'    => '',
            'subject'        => '',
            'keywords'       => '',
            'category'       => '',
            'manager'        => '',
            'company'        => '',
        ],

        /*
        |--------------------------------------------------------------------------
        | Cell Middleware
        |--------------------------------------------------------------------------
        |
        | Customize middleware for handling cell data.
        |
        */
        'cells' => [
            'middleware' => [
                // \Maatwebsite\Excel\Middleware\TrimCellValue::class,
                // \Maatwebsite\Excel\Middleware\ConvertEmptyCellValuesToNull::class,
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Extension Detector
    |--------------------------------------------------------------------------
    |
    | Configure the writer/reader to use based on the extension type.
    |
    */
    'extension_detector' => [
        'xlsx'     => Excel::XLSX,
        'xlsm'     => Excel::XLSX,
        'xltx'     => Excel::XLSX,
        'xltm'     => Excel::XLSX,
        'xls'      => Excel::XLS,
        'xlt'      => Excel::XLS,
        'ods'      => Excel::ODS,
        'ots'      => Excel::ODS,
        'slk'      => Excel::SLK,
        'xml'      => Excel::XML,
        'gnumeric' => Excel::GNUMERIC,
        'htm'      => Excel::HTML,
        'html'     => Excel::HTML,
        'csv'      => Excel::CSV,
        'tsv'      => Excel::TSV,

        /*
        |--------------------------------------------------------------------------
        | PDF Extension
        |--------------------------------------------------------------------------
        |
        | Configure the PDF driver for exporting to PDF format.
        | Available options: Excel::MPDF | Excel::TCPDF | Excel::DOMPDF
        |
        */
        'pdf' => Excel::DOMPDF,
    ],

    /*
    |--------------------------------------------------------------------------
    | Value Binder
    |--------------------------------------------------------------------------
    |
    | PhpSpreadsheet allows you to define how cell values should be formatted.
    | You can use default or advanced value binders.
    |
    */
    'value_binder' => [
        'default' => Maatwebsite\Excel\DefaultValueBinder::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    |
    | Configure how cell values are cached to avoid memory issues during
    | large exports or imports.
    |
    */
    'cache' => [
        'driver' => 'memory', // memory, illuminate, batch
        'batch' => [
            'memory_limit' => 60000,
        ],
        'illuminate' => [
            'store' => null, // Specify the cache store for illuminate driver
        ],
        'default_ttl' => 10800, // Cache TTL in seconds
    ],

    /*
    |--------------------------------------------------------------------------
    | Transaction Handler
    |--------------------------------------------------------------------------
    |
    | This defines whether to wrap import transactions in a database transaction.
    |
    */
    'transactions' => [
        'handler' => 'db',
        'db' => [
            'connection' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Temporary File Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the paths and permissions for temporary files.
    |
    */
    'temporary_files' => [
        'local_path' => storage_path('framework/cache/laravel-excel'), // Path for temporary files
        'local_permissions' => [
            // 'dir' => 0755,
            // 'file' => 0644,
        ],
        'remote_disk' => null, // For storing temporary files on a shared remote disk
        'remote_prefix' => null, // Prefix for the remote disk path
        'force_resync_remote' => null, // Force cleanup after each chunk if using remote disk
    ],
];
