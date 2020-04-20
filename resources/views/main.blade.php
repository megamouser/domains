<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Domains Statistics</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        ul.pagination > li
        {
            display: inline;
        }

        .table td, .table th
        {
            border-top: none;
        }

        .pagination 
        {
            justify-content: center;
            flex-wrap: wrap;
        }

        select:not([multiple])
        {
            -webkit-appearance:none;
            -moz-appearance:none;
            background-position:right 60%;
            background-repeat:no-repeat;
            background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA4AAAAMCAYAAABSgIzaAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NDZFNDEwNjlGNzFEMTFFMkJEQ0VDRTM1N0RCMzMyMkIiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NDZFNDEwNkFGNzFEMTFFMkJEQ0VDRTM1N0RCMzMyMkIiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo0NkU0MTA2N0Y3MUQxMUUyQkRDRUNFMzU3REIzMzIyQiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo0NkU0MTA2OEY3MUQxMUUyQkRDRUNFMzU3REIzMzIyQiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PuGsgwQAAAA5SURBVHjaYvz//z8DOYCJgUxAf42MQIzTk0D/M+KzkRGPoQSdykiKJrBGpOhgJFYTWNEIiEeAAAMAzNENEOH+do8AAAAASUVORK5CYII=);
            padding-right:1.5em;
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
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() 
    {
        if(window.location.pathname== "/domains")
        {
            if(window.location.search !== "")
            {
                uriParamsArray = window.location.search.substr(1).split("&");
                uriParamsObject = {};

                uriParamsArray.forEach(element => {
                    let elementKey = element.split("=")[0];
                    let elementValue = element.split("=")[1];

                    uriParamsObject[elementKey] = elementValue;
                });

                if(uriParamsObject.sort)
                {
                    let option = document.querySelector("option[value="+uriParamsObject.sort+"]");
                    option.selected = true;
                }
            }
        }

        // if(window.location.pathname == "/settings")
        // {
        //     const downloadFileButton = document.querySelector(".download-file");
        //     const deleteFileButton = document.querySelector(".delete-file");

        //     const sendHttpRequest = (method, url, data) =>
        //     {
        //         const promise = new Promise(
        //             (resolve, reject) => 
        //             {
        //                 const xhr = new XMLHttpRequest();

        //                 xhr.open(method, url);
        //                 xhr.responseType = "json";

        //                 if(data)
        //                 {
        //                     xhr.setRequestHeader("Content-Type", "application/json");
        //                 }

        //                 xhr.onload = () => 
        //                 {
        //                     if(xhr.status >= 400)
        //                     {
        //                         reject(xhr.response);
        //                     } 
        //                     else 
        //                     {
        //                         resolve(xhr.response);
        //                     }
        //                 };

        //                 xhr.onerror = () => 
        //                 {
        //                     reject("Something went wrong!");
        //                 };

        //                 xhr.send(JSON.stringify(data));
        //             }
        //         );

        //         return promise;
        //     }

        //     const getData = () =>
        //     {
        //         sendHttpRequest(
        //             "GET", 
        //             "https://reqres.in/api/users"
        //         ).then(responseData => {
        //             console.log(responseData);
        //         });
        //     };

        //     const sendData  = () => 
        //     {
        //         sendHttpRequest(
        //             "POST", 
        //             "https://reqres.in/api/register", 
        //             {
        //                 email: "eve.holt@reqres.in",
        //                 // password: "pistol"
        //             }).then(
        //             responseData => {
        //                 console.log(responseData);
        //             }).catch(err => {
        //                 console.log(err);
        //             });
        //     };

        //     downloadFileButton.addEventListener("click", getData);
        //     deleteFileButton.addEventListener("click", sendData);
        // };
    });
</script>
</html>