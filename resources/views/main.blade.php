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

        @media only screen and (max-width: 768px) {
            .actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    @yield('content')

    <div class="modal modalOne fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Extracting domains from storage</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="/archieve/extract" class="formOne">
                    @csrf

                    <div class="form-group">
                        <label for="domains-count" class="col-form-label">How many domains do you want to exctract?</label>
                        <input type="number" name="domainsCount" class="form-control" id="domains-count" placeholder="Enter domains count here" value="1000">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitOne" data-dismiss="modal">Extract</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal modalTwo fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Extracting domains from storage</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="/archieve/extractwithoutparams" class="formTwo">
                    @csrf

                    <div class="form-group">
                        <label for="domains-count" class="col-form-label">How many domains without statistic params do you want to exctract?</label>
                        <input type="number" name="domainsCount" class="form-control" id="domains-count" placeholder="Enter domains count here" value="1000">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitTwo" data-dismiss="modal">Extract</button>
            </div>
          </div>
        </div>
    </div>
    
</body>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    window.onload = function() {
        if(window.location.pathname== "/domains")
        {
            let sortElems = document.querySelectorAll(".sort");
            let searchForm = document.querySelector(".searchForm");
            let sortInput = document.querySelector("input[name=sort]");

            sortElems.forEach(element => {
                element.addEventListener("click", function(event) {
                    event.preventDefault();
                    if(sortInput.value == "") {
                        sortInput.value = this.innerHTML.toLowerCase();
                    } else {
                        if(sortInput.value == this.innerHTML.toLowerCase()) {
                            sortInput.value = "-" + this.innerHTML.toLowerCase();
                        } else {
                            sortInput.value = this.innerHTML.toLowerCase();
                        }
                    }

                    searchForm.submit();
                });
            });
        }

        if(window.location.pathname == "/statistics")
        {
            let getStatisticButton = document.querySelector(".get-statistic");
            let stopStatisticButton = document.querySelector(".stop-statistic");

            if(stopStatisticButton !== null) 
            {
                stopStatisticButton.addEventListener("click", function(event) 
                {
                    window.location.href = "/statistics/stopcollect";
                }); 
            }

            if(getStatisticButton !== null)
            {
                getStatisticButton.addEventListener("click", function(event) 
                {
                    window.location.href = "/statistics/collect";
                });
            }
        }

        if(window.location.pathname == "/archieve")
        {
            const modalOneAction = document.querySelector(".modalOneAction");
            const modalTwoAction = document.querySelector(".modalTwoAction");

            const modalOne = document.querySelector(".modalOne");
            const modalTwo = document.querySelector(".modalTwo");

            const formOne = document.querySelector(".formOne");
            const formTwo = document.querySelector(".formTwo");
            console.log(formTwo);

            modalOneAction.addEventListener("click", (event) => {
                $(modalOne).modal("show");
                const submitOne = document.querySelector(".submitOne");

                submitOne.addEventListener("click", (event) => {
                    $(formOne).submit();
                });
            });
            
            modalTwoAction.addEventListener("click", (event) => {
                $(modalTwo).modal("show");
                const submitTwo = document.querySelector(".submitTwo");
                
                submitTwo.addEventListener("click", (event) => {
                    $(formTwo).submit();
                });
            });
        }
    };
</script>
</html>