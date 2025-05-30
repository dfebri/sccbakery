<link type="text/css" rel="stylesheet" href="{{ URL::asset($asset_path.'css/styles.css') }}" />
<link type="text/css" href="{{ URL::asset($asset_path.'css/bootstrap.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset($asset_path.'css/bootstrap-theme.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset($asset_path.'css/font-awesome.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset($asset_path.'css/styles.css') }}" rel="stylesheet">
@if($loadjqueryui)
<link rel="stylesheet" type="text/css" href="{{ URL::asset($asset_path.'css/smoothness/jquery-ui-1.10.4.custom.min.css')}}">
@endif
@if($loadjquerytokenize)
<link rel="stylesheet" type="text/css" href="{{ URL::asset($asset_path.'css/jquery.tokenize.css')}}">
@endif
@if($loadjquerymultiselect)
<link rel="stylesheet" type="text/css" href="{{ URL::asset($asset_path.'css/multi-select.css')}}">
@endif
