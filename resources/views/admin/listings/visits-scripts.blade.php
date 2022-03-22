<script>
  //toggle-heart
  @if(!empty($items))
  @foreach($items as $item)
  $(document).on('click', '#schedule-visit_{{$item->id}}', function(e) {
    e.preventDefault();
    var _token = $("input[name='_token']").val();

    $.ajax({
      url: "{{route('property.visit')}}",
      type: 'POST',
      data: {
        _token: _token,
        property_id: '{{$item->id}}'
      },
      success: function(data) {
        if ($.isEmptyObject(data.error)) {

          alert(data.success);
          location.reload();

        }
      }
    });

   

  });

  @endforeach
  @endif

 
</script>