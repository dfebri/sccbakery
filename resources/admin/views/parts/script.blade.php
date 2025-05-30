<!-- <script type="text/javascript" src="{{ URL::asset($asset_path.'js/jquery.min.js') }}"></script> -->
<script src="http://code.jquery.com/jquery-1.9.0rc1.js"></script>
<script type="text/javascript" src="{{ URL::asset($asset_path.'js/bootstrap.min.js') }}"></script>
@if($loadjqueryui)
<script type="text/javascript" src="{{ URL::asset($asset_path.'js/jquery-ui-1.10.4.custom.min.js')}}"></script>
@endif
@if($loadjquerytokenize)
<script type="text/javascript" src="{{ URL::asset($asset_path.'js/jquery.tokenize.js')}}"></script>
@endif
@if($loadjquerymultiselect)
<script type="text/javascript" src="{{ URL::asset($asset_path.'js/jquery.multi-select.js')}}"></script>
@endif


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
//DROP DOWN MENU
$(function() {
    $("li.dropdown").bind({
        "mouseenter" : function() {
            $( "ul", this ).stop(true, false).slideDown('fast');
        },
        "mouseleave" : function() {
            $( "ul", this ).stop(true, false).slideUp('fast');
        }
    });

    @if($loadjqueryui)
    $(".datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "yy-mm-dd"
    });
    @endif
    @if($loadjquerymultiselect)
    $(".multiselect").multiSelect();
    @endif
    @if($loadjquerytokenize)
    $(".tokenize").tokenize({
            'newElements' : false
        });
    @endif

    @if($sortable)
    $('.ordering-content').sortable({ opacity: 0.8, cursor: 'move'});
    @endif

    @if($ajax_checkbox)
    $("a.on").click(function(){
        var parent  = $(this).parents('.ajax-btn');
        var clicked = $(this);
        $.get($(this).attr('href'), function(data){
            if(data == '1'){
                clicked.addClass('hide');
                $(".off", parent).removeClass('hide');
            }else{
                alert(data);
            }
        });
        return false;
    });
    $("a.off").click(function(){
        var parent  = $(this).parents('.ajax-btn');
        var clicked = $(this);
        $.get($(this).attr('href'), function(data){
            if(data == '1'){
                clicked.addClass('hide');
                $(".on", parent).removeClass('hide');
            }else{
                alert('Update failed!');
            }
        });
        return false;
    });
    @endif
});
</script>

@if( isset($loadsearch) )
<script type="text/javascript">
function collect_and_search(){
     var query = '';
    $(".search").each(function(idx){
        if($(this).val() != ''){
            query += '&' + $(this).attr('name') + '=' + $(this).val();
        }
    });
    var base_url = '{{ URL::to($base_url)}}';
    if(base_url.indexOf('?') < 0)
        var url = base_url + '?' + query.trim('&');
    else
        var url = base_url + query.trim('&');

    window.location = url;

    return false;
}
$(function(){
    $(".search").change(function(){
        var go = true;
        if($(this).hasClass('date-range')){
            if($(".field1").val() == '' || $(".field2").val() == ''){
                go = false;
            }
        }
        if(go){
            collect_and_search();
        }
    });
});
</script>
@endif
@if(isset($multiple_delete))
<script type="text/javascript">
function do_multiple_delete(){
    var  items = '';
    $(".check_item:checked").each(function(idx){
        items += "<input type='hidden' name='check_item[]' value='"+$(this).val()+"'/>";
    });
    items+= '<input type="hidden" name="_token" value="{{ csrf_token() }}" />';
    $("#form-multiple-delete").html(items).submit();
}
$(function(){
    $("#btn-multiple-delete").click(function(){
        var yes = confirm('Are you sure to delete selected items?');
        if(yes && $(".check_item:checked").length > 0)
            do_multiple_delete();

        return false;
    });
    $("#check_all").change(function(){
        if($(this).is(":checked")){
            $(".check_item").prop('checked', true);
        }else{
             $(".check_item").prop('checked', false);
        }
    });
    $(".check_item").change(function(){
        if(!$(this).is(":checked")){
            $("#check_all").prop('checked', false);
        }
    });
});
</script>
@endif

{!! JS::render() !!}

<script type="text/javascript">
    function before_delete(element){
        var row = $(element).parents('tr');
        var yes = confirm('Are you sure to delete this data?');
        row.addClass('selected');
        if(!yes){
            row.removeClass('selected');
            return false;
        }
    }
    function submit_form(formid){
        formid = formid || 'form-scaffold';
        $("#"+formid).submit();
        return false;
    }
    function order_filter(){
        var qs = '';
        $(".order_filter").each(function(){
            qs = "&" + $(this).attr('name') + "=" + $(this).val();
        });

        window.location = '{{ Request::url()}}?act=order'+qs;
    }
</script>
