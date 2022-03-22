@inject('request', 'Illuminate\Http\Request')
@extends( 'layouts.new_admin_layout' )

@section('new_content')
<style>
    .sty-tc{
      text-align: center;
    }
    #sty-mrpl{
        margin-right: 5px;color:#ff0000;padding-left: 20px;
    }
  </style>
    <h3 class="page-title"> {{getPhrase('settings')}} </h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">


           <table class="table table-bordered table-striped {{ count($records) > 0 ? 'datatable' : '' }} ">

                <thead>
                    <tr>
                        <th class="sty-tc">S.no.</th>

                        <th> {{getPhrase('module')}} </th>
                        <th> {{getPhrase('key')}} </th>
                        <th> {{getPhrase('description')}} </th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                @if (count($records) > 0)
                 <tbody>
                    <?php $i=0;?>
                    @if (count($records) > 0)
                        @foreach ($records as $record)
                        <?php $i++;?>
                            <tr data-entry-id="{{ $record->id }}">

                                <td class="sty-tc">{{$i}}</td>

                                <td field-key='title'> <a href="{{URL_SETTINGS_VIEW}}{{$record->slug}}"> {{ ucwords($record->title) }} </a></td>
                                <td field-key='key'>{{ $record->key }}</td>
                                <td field-key='description'>{{ $record->description }}</td>



                                <td>

                                    @can('category_edit')
                                    <a href="{{ URL_SETTINGS_EDIT }}{{$record->slug}}" class="btn btn-xs btn-info">{{getPhrase('edit')}}</a>
                                    @endcan

                                    @can('category_view')
                                     <a href="{{ URL_SETTINGS_VIEW }}{{$record->slug}} " class="btn btn-xs btn-primary"> {{getPhrase('view')}} </a>
                                    @endcan


                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"> {{getPhrase('no_entries_in_table')}} </td>
                        </tr>
                    @endif
                </tbody>
                @endif
            </table>
        </div>
    </div>
@stop

@section('new_admin_js_scripts')



@endsection