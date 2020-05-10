
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{url('dashboard')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery -->
<script src="{{url('dashboard')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('dashboard')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('dashboard')}}/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="{{url('dashboard')}}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{url('dashboard')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Summernote -->
<script src="{{url('dashboard')}}/plugins/summernote/summernote-bs4.min.js"></script>

<script>

    $(function () {
        // Summernote
        $('.textarea').summernote()
    })

    $(function () {
        $("#example1").DataTable();
    });
    $('.btn-delete').click(function () {
        swal({
            title: "DO you Want To Do This",
            icon: "warning",
            // buttons: true,
            buttons: {
                cancel: "No",
                ok: "Ok"
            },
            dangerMode: true,
        })
            .then((confirmed) => {
                if (confirmed) {
                    $(this).parents('form').submit()
                }
            });
    });



    if(document.getElementById('messageCount'))
    {
        $.ajax({
            type: 'GET',
            url: '',
            dataType:'html',
            success:function (data) {

                document.getElementById('messageCount').innerText='+'+data;
                document.getElementById('messageCount2').innerText='+'+data;
            },
            fail:function  (error) {
                alert("mno")
                console.log(error);
            }
        });
    }



</script>
</body>
</html>
