@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @push('scripts')
        <script>
            $(document).ready(function () {
                let $select = $('.js-data-example-ajax');

                $select.select2({
                    ajax: {
                        url: '/api/categories',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return { term: params.term };
                        },
                        processResults: function (data) {
                            return { results: data.results };
                        },
                        cache: true
                    },
                    placeholder: 'Select categories',
                    allowClear: true
                });

                let selectedData = @json($selectedCategories ?? []);
                selectedData.forEach(item => {
                    let option = new Option(item.text, item.id, true, true);
                    $select.append(option).trigger('change');
                });
            });
        </script>
    @endpush


    <style>
        .select2-container .select2-selection--multiple {
            background-color: #374151;
            color: #fff;
            border: 1px solid #4b5563;
            border-radius: 0.375rem;
            min-height: 42px;
            padding: 4px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #2563eb;
            color: #fff;
            border: none;
            border-radius: 0.375rem;
            padding: 2px 6px;
            margin-top: 4px;
        }

        .select2-container--default .select2-results__option {
            color: #000;
        }

        .select2-container--default .select2-results__option--highlighted {
            background-color: #2563eb;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            color: #fff;
        }
    </style>
@endpush
