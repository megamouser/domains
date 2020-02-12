<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Domains Statistics</title>
    <style>
        ul.pagination > li
        {
            display: inline;
        }

    </style>
</head>
<body>
    <div>
        Domains Statistics Application
    </div>

    @yield('content')
</body>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous">
</script>
<script>
    $(function() 
    {
        /**
         *    Sending ajax request
        */
        $.ajax
        (
            {
                type: "POST", 
                url: "/test", 
                data: { somefield: "Some field value", _token: "{{ csrf_token() }}"},

                success: function(response) 
                {
                    console.log(response)
                }
            }
        )

        $("[name='search']").keyup
        (
            function(event) 
            {
                console.log($(this).val())
            }
        )
    })

</script>
</html>