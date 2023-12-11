/*  お気に入りリスト  */

let click = 0;

for (let i = 1; i <= $('.list-size').val(); i++) {
    $(`.btn-delete-${i}`).on('click', function() {
        if (click == 0) {
            click = 1;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:'ajax/delete_favorite',
                dataType: 'json',
                data: {
                    id: $('.id').val(),
                    list_id: $(`.list-id-${i}`).val()
                }
            }).done(function (res) {
                $('.reload').submit();
                click = 0;
            }).fail(function (res) {
                alert(res.id + ':' + res.list_id);
            });
        }
    });
}
