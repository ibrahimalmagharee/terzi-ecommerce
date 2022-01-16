@extends('layouts.admin')
@section('title')
    مبيعات منتجات|التصميم
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> مبيعات منتجات التصميم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a></li>
                                <li class="breadcrumb-item active"> مبيعات منتجات التصميم</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
{{--                                    <label for="projectinput2">اختر التاجر</label>--}}

{{--                                    <label>المجموع الكلي</label>--}}
{{--                                    <input type="text" value="{{$total_price}}">--}}
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-content collapse show" id="viewDesigns">
                                    <div class="card-body card-dashboard table-responsive">
{{--                                        <div class="dt-buttons btn-group">--}}
{{--                                        <a class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="purchase-design-table" href="#"><span>Copy</span></a>--}}
{{--                                            <a class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="purchase-design-table" href="#"><span>Excel</span></a>--}}
{{--                                            <a class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="purchase-design-table" href="#"><span>CSV</span></a>--}}
{{--                                            <a class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="purchase-design-table" href="#"><span>PDF</span></a>--}}
{{--                                        </div>--}}

                                    <table class="table  display table-striped  purchase-design-table">

                                            <thead>
                                            <tr>
                                                <th>التاجر </th>
                                                <th>الزبون </th>
                                                <th>اسم المنتج</th>
                                                <th>القسم</th>
                                                <th>تاريخ البيع</th>
                                                <th>الكمية</th>
                                                <th>السعر</th>
                                                <th>المجموع الكلي</th>

                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                            <tr>
                                                <th colspan="7" style="text-align:right;  white-space: nowrap;">المجموع الكلي : </th>
                                                <th></th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div class="row mt-1">
                                            <div class="col-md-3">
                                                <select name="vendor_id" data-vendor="0" id="vendor_id" class="form-control">
                                                    <optgroup label="الرجاء اختر التاجر">
                                                        <option value="">اختر التاجر</option>
                                                        @isset($data['vendors'])
                                                            @foreach($data['vendors'] as $vendor)
                                                                <option value="{{$vendor->name}}">{{$vendor->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" data-name="2" name="name" id="name_filter" class="form-control" placeholder="اسم المنتج">
                                            </div>
                                            <div class="col-md-3">
                                                <select name="category_id" data-category="3" id="category_id_filter" class="form-control">
                                                    <optgroup label="الرجاء اختر القسم">
                                                        <option value="">اختر القسم</option>
                                                        @isset($data['categories'] )
                                                            @foreach($data['categories'] as $category)

                                                                <option value="{{$category->name}}">{{$category->name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="date" data-created="4" name="created_at" id="created_at_filter" class="form-control">
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Show Table
            var purchaseDesignTable = $('.purchase-design-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{route("purchase.design")}}",
                columns: [
                    {data: 'vendor', name: 'vendor'},
                    {data: 'customer', name: 'customer'},
                    {data: 'name', name: 'name'},
                    {data: 'category', name: 'category'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'price', name: 'price'},
                    {data: 'total_price', name: 'total_price', orderable: false, searchable: false},
                ],
                language: {"url": "{{asset('/public/assets/admin/js/dataTableArabic.json')}}"},
                "dom":  '<"rt-buttons"Bf><"clear">ltip',
                "paging": true,
                "autoWidth": true,
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 7, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    // Update footer
                    $( api.column( 7 ).footer() ).html(
                        '$'+pageTotal +' ( $'+ {{$total_price}} +' المجموع الكلي)'
                    );

                },

                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'اكسيل',
                        autoFilter: true,
                        sheetName: 'Exported data',
                        footer: true ,
                        exportOptions: {
                            orthogonal: 'excel',
                    },
                    },

                ],





            });


            $('select[name="vendor_id"]').on('change',function(){
                purchaseDesignTable.column($(this).data('vendor')).search($(this).val()).draw();

            });

            $('#name_filter').on('keyup',function(){
                purchaseDesignTable.column($(this).data('name')).search($(this).val()).draw();

            });

            $('select[name="category_id"]').on('change',function(){
                purchaseDesignTable.column($(this).data('category')).search($(this).val()).draw();

            });

            $('#created_at_filter').on('change',function(){
                purchaseDesignTable.column($(this).data('created')).search($(this).val()).draw();

            });


        });

    </script>
@endsection
