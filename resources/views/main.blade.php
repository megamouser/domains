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

        .page-item.active 
        .page-link
        {
            background-color: #343a40;
            border-color: #343a40;
        }

        .page-link
        {
            color: #343a40;
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
    //     $("[name='search']").keyup
    //     (
    //         function(event) 
    //         {
    //             console.log($(this).val())
    //         }
    //     )

    //     $(".update_statistic").click(function(event) 
    //     {
    //         let domainName = $(this).data("domain")
    //         ajaxRequest("POST", "/options", { "domainName": domainName, "_token": "{{ csrf_token() }}" })
    //     })

    //     if($(".update_statistic").length > 0) 
    //     {
    //         $(".update_statistic")
    //         massRequests($(".update_statistic"))
    //     }
    //     else 
    //     {
    //         console.log("elements not found")
    //     }
    // })

    // function ajaxRequest(type, url, data)
    // {
    //     $.ajax
    //     (
    //         {
    //             type: type, 
    //             url: url, 
    //             data: data,

    //             success: function(response) 
    //             {
    //                 console.log(response);
    //             }
    //         }
    //     )
    // }

        class RequestMaker 
        {
            // constructor(params = {})
            // {
            //     this.params = params;
            //     // this.loadingSpinner = 
            //     //     `<div class="row justify-content-center mt-5">
            //     //         <div class="spinner-border" role="status">
            //     //             <span class="sr-only">Loading...</span>
            //     //         </div>
            //     //     </div>`;
                
            //     // this.domainsTablePlace = $(".domainsTable");
            //     // this.itemsOnPage = itemsOnPage;
            //     // this.itemsPage = itemsPage;
            //     // this.columns = columns;

            //     // this.getDataRequest(this.itemsOnPage, this.itemsPage);
            // }


            makeRequest(url)
            {
                $.ajax
                (
                    {
                        type: "post",
                        url: url,
                        data: {
                            "params": this.params,
                            "_token": "{{ csrf_token() }}"
                        }
                    }
                ).done((data) => 
                {
                    console.log(data);
                })
            }

            setParams(params = {})
            {
                this.params = params;
            }

            // loadSpinnerIntoTablePlace()
            // {
            //     this.domainsTablePlace.html(this.loadingSpinner);
            // }

            // updateDataRequest(itemsOnPage = this.itemsOnPage, itemsPage = this.itemsPage)
            // {
            //     this.itemsOnPage = itemsOnPage;
            //     this.itemsPage = itemsPage;

            //     this.getDataRequest(this.itemsOnPage, this.itemsPage);
            // }

            // getDataRequest(itemsOnPage, pageNumber)
            // {
            //     this.loadSpinnerIntoTablePlace();

            //     $.ajax 
            //     (
            //         {
            //             type: "post",
            //             url: "/domains/getDomains",
            //             data: 
            //             {
            //                 "itemsOnPage": itemsOnPage,
            //                 "pageNumber": pageNumber, 
            //                 "dataType": "application/json",
            //                 "_token": "{{ csrf_token() }}"
            //             }
            //         }
            //     ).done((data) => 
            //     { 
            //         this.data = data;
            //         this.data.keys = Object.keys(this.data.itemsChunk[0]);

            //         if(this.data) 
            //         {
            //             this.loadTableMain(this.data);
            //             this.loadTableContent(this.data);
            //             this.loadNavigation(this.data);

            //         }
            //     })
            // }

            // loadTableMain(response) 
            // {
            //     let columnsString = "";
                
            //     for (let [key, value] of Object.entries(this.columns)) 
            //     {
            //         columnsString += `<th scope="col">` + value + `</th>`; 
            //     }

            //     let domainsTable = $(".domainsTable");
            //     domainsTable.html("");
            //     domainsTable.html
            //     (`<table class="table table-bordered table-striped rounded">
            //         <thead>
            //             <tr>` + columnsString + `</tr>
            //         </thead>
            //         <tbody class='domainsTableBody'></tbody>
            //     </table>
            //     <nav>
            //         <ul class="pagination">
            //             <li class="page-item previous">
            //                 <a class="page-link" href="#" aria-label="Previous">
            //                     <span aria-hidden="true">&laquo;</span>
            //                     <span class="sr-only">Previous</span>
            //                 </a>
            //             </li>
            //             <div class="page-item">
            //                 <div class="page-link"><span class="pageNumberStart">` + ++response.chunkNumber + `</span> / <span class="pageNumberStop">` + response.chunksCount + `</span></div>
            //             </div>
            //             <li class="page-item next">
            //                 <a class="page-link" href="#" aria-label="Next">
            //                     <span aria-hidden="true">&raquo;</span>
            //                     <span class="sr-only">Next</span>
            //                 </a>
            //             </li>
            //         </ul>
            //     </nav>`);
            // }

            // loadTableContent(data)
            // {
            //     let domainsTableBody = $(".domainsTableBody");
            //     let domainsTableBodyContent = "";
            //     domainsTableBody.html("");

            //     data.itemsChunk.forEach(element => 
            //     {
            //         domainsTableBodyContent += 
            //         `<tr>
            //             <th scope="row">` + element.id + `</th>
            //             <td><a href="/domains/` + element.id + `">` + element.name + `</a></td>
            //             <td scope="row">` + element.created_at + `</td>
            //         </tr>`;
            //     });

            //     domainsTableBody.html(domainsTableBodyContent);
            // }

            // loadNavigation(data)
            // {
            //     this.maxPageCount = data.chunksCount;
            //     if(this.itemsPage > 0)
            //     {
            //         $(".previous").click((event) => 
            //         {
            //             event.preventDefault();
            //             this.changeSettings(this.itemsOnPage, this.itemsPage - 1);
            //         });
            //     }
            //     else
            //     {
            //         $(".previous").addClass("disabled");
            //     }

            //     if(this.itemsPage < this.maxPageCount - 1)
            //     {
            //         $(".next").click((event) => 
            //         {   
            //             event.preventDefault();
            //             this.changeSettings(this.itemsOnPage, this.itemsPage + 1);
            //         });
            //     } 
            //     else 
            //     {
            //         $(".next").addClass("disabled");
            //     }
            // }
        }

        // requestMaker.setParams({itemsInOnePage: 150, itemsPageNumber: 0, search: "" });
        // requestMaker.makeRequest("/domains/getDomains");
        // requestMaker.setParams({itemsInOnePage: 150, itemsPageNumber: 2, search: "t" });
        // requestMaker.makeRequest("/domains/getDomains");
        
        let requestMaker = new RequestMaker;
        let searchInput = $("input[name=search]");
        let countItemsInput = $("input[name=itemsCount]");
        let countPagesInput = $("input[name=pageCount]");

        searchInput.on('keyup change', function(event) 
        {
            console.log(this.value);
        })        
        
        countItemsInput.on('keyup change', function(event) 
        {
            console.log(this.value);
        })

        // function getDomains(itemsOnPage, pageNumber)
        // {
        //     let domainsTable = $(".domainsTable");
        //     domainsTable.html(spinner);

        //     $.ajax 
        //     (
        //         {
        //             type: "post",
        //             url: "/domains/getDomains",
        //             data: 
        //             {
        //                 "itemsOnPage": itemsOnPage,
        //                 "pageNumber": pageNumber, 
        //                 "_token": "{{ csrf_token() }}"
        //             },

        //             success: function(response) {
        //                 loadTableMain(response);
        //                 loadTableContent(response);
        //                 activateNavigation();
        //             }
        //         }
        //     )
        // }

        // function loadTableContent(response)
        // {
        //     let domainsTableBody = $(".domainsTableBody");
        //     domainsTableBody.html("");
        //     domainsTableBodyContent = "";

        //     response.itemsChunk.forEach(element => 
        //     {
        //         domainsTableBodyContent += 
        //         `<tr>
        //             <th scope="row">` + element.id + `</th>
        //             <td><a href="/domains/` + element.id + `">` + element.name + `</a></td>
        //             <td scope="row">` + element.created_at + `</td>
        //         </tr>`;
        //     });

        //     domainsTableBody.html(domainsTableBodyContent);
        // }

        // function activateNavigation()
        // {
        //     $(".previous").click(function(event) 
        //     {
        //         event.preventDefault();
                
        //         let start = $(".pageNumberStart").html();
        //         let stop = $(".pageNumberStop").html();
        //         if(start > 1) 
        //         {
        //             start--;
        //             $(".pageNumberStart").html(start);
        //             getDomains(500, start);
        //             console.log(start);
        //         }
        //     });

        //     $(".next").click(function(event) 
        //     {
        //         event.preventDefault();

        //         let start = +$(".pageNumberStart").html();
        //         let stop = +$(".pageNumberStop").html();

        //         if(start < stop)
        //         {
        //             start++;
        //             $(".pageNumberStart").html(start);
                    
        //             $.ajax 
        //             (
        //                 {
        //                     type: "post",
        //                     url: "/domains/getDomains",
        //                     data: 
        //                     {
        //                         "itemsOnPage": start,
        //                         "pageNumber": stop, 
        //                         "_token": "{{ csrf_token() }}"
        //                     },

        //                     success: function(response) 
        //                     {
        //                         loadTableMain(response);
        //                         // loadTableContent(response);
        //                         // activateNavigation();
        //                     }
        //                 }
        //             )
        //         }
        //     });
        // }

        // activateNavigation();

        // function massRequests(elements) 
        // {
        //     if(elements.length) 
        //     {
        //         elements.each(function(index) 
        //         {
        //             let domainName = $(this).data("domain")
        //             ajaxRequest("POST", "/options", { "domainName": domainName, "_token": "{{ csrf_token() }}" })
        //         }) 
        //     } 

        //     let uri = window.location.pathname.substring(1);
        //     if(uri === "domains")
        //     {
        //         getDomains(4000, 0);
        //     }
        // }
    });
</script>
</html>