<script>
  //toggle-heart
  @if(!empty($items))
  @foreach($items as $item)
    var heart_color = 'red';
    $(document).on('click', '#property-heart_{{$item->id}}', function(e) {
      e.preventDefault();
      var _token = $("input[name='_token']").val();
      if (heart_color == 'red') {
        $(this).css("color", "#FFF");
        heart_color = 'white';
      } else {
        $(this).css("color", "red");
        heart_color = 'red';
      }

      $.ajax({
        url: "{{route('property.shortlist')}}",
        type: 'POST',
        data: {
          _token: _token,
          property_id: '{{$item->id}}',
          heart_color: heart_color
        },
        success: function(data) {
          if ($.isEmptyObject(data.error)) {
            if (heart_color == "red") {
              alert(data.success);
              location.reload();
            } 
          }
        }
      });


    });

  @endforeach
  @endif

   
</script>