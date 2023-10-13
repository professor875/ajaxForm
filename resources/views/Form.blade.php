<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite('resources/css/app.css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Ajax</title>
</head>
<body class="bg-slate-700 text-white">


<div class=" pt-32 flex justify-center">

    <button id="lala" class="hidden mt-32 absolute px-5 py-4 font-bold text-sm rounded-xl bg-green-600 text-white border-none hover:bg-green-700">Open Form</button>
    <form class="border border-white p-10 rounded-xl" id="form">
        @csrf
        <h1 class="font-bold text-3xl mb-5 text-white">FormData</h1>
        <x-form-input label="name"/>
        <x-form-input label="email"/>
        <x-form-input label="password" type="password"/>

        <p id="response" class=""></p>

        <button id="submit" class="px-5 py-3 font-bold text-sm rounded-xl bg-green-600 text-white border-none hover:bg-green-700">Submit</button>
    </form>
</div>
<script>
    $(document).ready(function () {
        $("#lala").click(function (){
            $(this).fadeOut("slow");
            $("#form").slideDown("slow");

        });
        $("#form").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            var csrfToken = $(this).find('input[name="csrf-token"]').val();

            let name = $("#name").val();
            let email = $("#email").val();
            let password = $("#password").val();

            if(name == "" || email == "" || password == "" ){
                $("#response").html("All fields are required").removeClass("success").addClass("error");
                setTimeout(function (){
                    $("#form").slideUp("slow");
                    $("#lala").fadeIn("900")
                },5000);
            }else{
                // $("#response").html($('#form').serialize());
                $.ajax({
                    url: "{{ route("submit") }}",
                    method: "POST",
                    data: $('#form').serialize(),
                    header: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (msg) {
                        $("#response").html(msg).removeClass("error").addClass("success");
                        setTimeout(function (){
                            $("#form").slideUp("slow");
                            $("#lala").fadeIn("900")
                        },5000);
                    }

                });
            }







            /*$.ajax({
                type: "POST",
                url: "{{ route("submit") }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Send the token in the header
                },
                success: function (response) {
                    $("#response").fadeIn();
                    $("#response").addClass("success").html(response).removeClass(".error");
                    setTimeout(function (){
                        $("#form").slideUp("slow");
                        $("#lala").fadeIn("900")
                    },5000);
                },
                error: function (xhr, status, error) {
                    $("#response").fadeIn();
                    $("#response").removeClass("success").html(error).addClass(".error");
                }
            });*/
        });




    });
</script>
</body>
</html>
