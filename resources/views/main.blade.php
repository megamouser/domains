<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Domains Statistics</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <style>
        ul.pagination > li
        {
            display: inline;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous">
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<script>
    $(document).ready(function() 
    {
        $("[name='search']").keyup
        (
            function(event) 
            {
                console.log($(this).val())
            }
        )

        $(".update_statistic").click(function(event) 
        {
            let domainName = $(this).data("domain")
            ajaxRequest("POST", "/options", { "domainName": domainName, "_token": "{{ csrf_token() }}" })
        })

        if($(".update_statistic").length > 0) 
        {
            $(".update_statistic")
            massRequests($(".update_statistic"))
        }
        else 
        {
            console.log("elements not found")
        }
    })

    function ajaxRequest(type, url, data)
    {
        $.ajax
        (
            {
                type: type, 
                url: url, 
                data: data,

                success: function(response) 
                {
                    console.log(response)
                }
            }
        )
    }

    function massRequests(elements) 
    {
        if(elements.length) 
        {
            elements.each(function(index) 
            {
                let domainName = $(this).data("domain")
                ajaxRequest("POST", "/options", { "domainName": domainName, "_token": "{{ csrf_token() }}" })
            }) 
        } 
    }

    function sleep(delay) 
    {
        var start = new Date().getTime();
        while (new Date().getTime() < start + delay);
    }
</script>
</html>