$(function () {
    var result = $("#news_list");
    var paginates = $(".pagination");
    var newsAll = [];

    //Search with status
    $(".select-active").on("change", function (event) {
        $('input[name="text_search"]').val("");
        var target = $(event.target);

        active_search = target.val();

        $.ajax({
            type: "GET",
            url: "news",
            typeData: "JSON",
            data: {
                active_search: active_search,
                status: 200,
            },
            success: function (data) {
                newsAll = data.news;
                if (newsAll) {
                    //Pagination
                    var newsPage = newPage(data.news, 5, 1);
                    //news list
                    newsHtml(newsPage, result);
                    // Set numbers of pages
                    numberPages(newsAll.length);
                    //Set active
                    $(".page_1").addClass("active");
                    //end paginate
                } else {
                    $(result).html("");
                    $(paginates).html("");
                }
            },
        });
    });
    //Search with Name news
    $('input[name="text_search"]').keyup(function () {
        $(".select-active").val("");
        var data_id = $(this).val();
        //ajax
        ajax(data_id);
    });
    //Change active
    result.on("click", ".btn-status", function () {

        var new_id = $(this).data("id");
        var active = $("#is-active" + new_id).val();
        Swal.fire({
            title: 'Xác nhận thay đổi?',
            text: "Bạn chấp nhận thay đổi trạng thái!",
            icon: 'Cảnh báo',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Accept'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    dataType: "JSON",
                    url: "new/active",
                    data: {
                        active: active,
                        new_id: new_id,
                    },
                    success: function (data) {
                        Swal.fire(
                            "Successful!",
                            "Thay đổi trạng thái thành công!",
                            "success"
                        );
                        $(".btn-active" + new_id).css("color", data.color);
                        $("#icon-active" + new_id)
                            .addClass(data.btnActive)
                            .removeClass(data.btnRemove);
                        $("#is-active" + new_id).val(data.value);
                        //Handle List news
                        console.log(newsAll);
                        for (let i = 0; i < newsAll.length; i++) {
                            if (newsAll[i]["id"] === new_id) {
                                newsAll[i]["active"] = data.value;
                            }
                        }
                    },
                });
            }
        })
    });
    //Delete new
    result.on("click", ".delete", function () {
        var token = $(this).data("token");
        id = $(this).data("id");
        Swal.fire({
            title: 'Xác nhận thay đổi?',
            text: "Bạn chấp nhận xóa!",
            icon: 'Cảnh báo',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Accept'
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    url: "news/" + id,
                    type: "DELETE",
                    dataType: "JSON",
                    data: {
                        id: id,
                        _method: "DELETE",
                        _token: token,
                    },
                    success: function (data) {
                        Swal.fire("Successful!", "Xóa thành công!", "success");
                        $(".ele_" + id).remove();
                        //Handle List news

                        for (let i = 0; i < newsAll.length; i++) {
                            if (newsAll[i]["id"] === id) {
                                newsAll.splice(i, 1);
                            }
                        }
                    },
                });
            }
        })
    });
    //Paginate

    //Click numberPage
    paginates.on("click", "#page_item", function () {
        page_id = $(this).data("id");

        newsPage = newPage(newsAll, 5, page_id);

        newsHtml(newsPage, result);

        numberPages(newsAll.length, page_id);

        $("#page_item").removeClass("active");
        $(".page_" + page_id).addClass("active");
    });
    //Click pre
    paginates.on("click", "#pre_paginate", function () {
        page_id = $(".curent_page").val();
        if (page_id == 1) {
            page_id = 1;
        } else {
            page_id = page_id - 1;
        }

        newsPage = newPage(newsAll, 5, page_id);

        newsHtml(newsPage, result);

        numberPages(newsAll.length, page_id);

        $("#page_item").removeClass("active");
        $(".page_" + page_id).addClass("active");
    });

    //Click next
    paginates.on("click", "#next_paginate", function () {
        page_id = $(".curent_page").val();
        if (page_id == Math.ceil(newsAll.length / 5)) {
            page_id = Math.ceil(newsAll.length / 5);
        } else {
            page_id = Number(page_id) + 1;
        }

        console.log(page_id);

        newsPage = newPage(newsAll, 5, page_id);

        newsHtml(newsPage, result);

        numberPages(newsAll.length, page_id);

        $("#page_item").removeClass("active");
        $(".page_" + page_id).addClass("active");
    });

    pre = `
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item" id="pre_paginate">
                <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
    `;
    nex = `
            <li class="page-item" id="next_paginate">
                    <a class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    `;

    // Ajax search news
    function ajax(data) {
        $.ajax({
            type: "GET",
            url: "news",
            typeData: "JSON",
            data: {
                text_search: data,
                status: 200,
            },
            success: function (data) {
                newsAll = data.news;
                if (newsAll) {
                    //Pagination
                    var newsPage = newPage(data.news, 5, 1);
                    //news list
                    newsHtml(newsPage, result);
                    // Set numbers of pages
                    numberPages(newsAll.length);
                    //Set active
                    $(".page_1").addClass("active");
                    //end paginate
                } else {
                    $(result).html("");
                    $(paginates).html("");
                }
            },
        });
    }
    // news list
    function newsHtml(array, ele) {
        $(ele).html("");
        array.forEach((element, index) => {
            $(ele).append(
                `
                <tr class="ele_${ element.id }">
                    <td>
                        <div class="checkbox">
                            <input id="check-item-1" type="checkbox">
                            <label for="check-item-1" class="m-b-0"></label>
                        </div>
                    </td>
                    <td>#${element.id}</td>
                    <td>${element.title}</td>
                    <td><img width="100px" src="${element.image_path}" alt=""></td>
                    <td>
                        <div class="text-center" style="cursor: pointer">
                        ${
                            element.active === 1
                                ? `<div class="m-r-10"></div>
                            <input type="hidden" id="is-active${element.id}"
                                value="${element.active}">
                            <div class="btn-status" data-id="${element.id}">
                                <i style="color: red"
                                    class="bi bi-lock-fill btn-active${element.id}"
                                    id="icon-active${element.id}"></i>
                            </div>`
                                : `
                                    <div class="m-r-10"></div>
                            <input type="hidden" id="is-active${element.id}"
                                value="${element.active}">
                            <div class="btn-status" data-id="${element.id}">
                                <i style="color: green"
                                    class="bi bi-unlock-fill btn-active${element.id}"
                                    id="icon-active${element.id}"></i>
                            </div>
                                    `
                        }
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="news/${element.id}/edit">
                        <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                            <i class="anticon anticon-edit"></i>
                        </button>
                        </a>
                        <button
                            class="btn btn-icon btn-hover btn-sm btn-rounded delete" data-id="${
                                element.id
                            }">
                            <i class="anticon anticon-delete"></i>
                        </button>
                    </td>
                </tr>
                `
            );
        });
    }

    //Number pages
    function numberPages(numbernews, curentPage = 1) {
        pages = Math.ceil(numbernews / 5);
        tempt = 1;
        arr = [];
        c = curentPage;
        for (let i = 1; i <= pages; i++) {
            if (curentPage === 1) {
                arr.push(i);
                if (arr.length >= 10) {
                    arr.push("string", pages - 1, pages);
                    break;
                }
            } else if (curentPage >= 10) {
                if (arr.length <= 2) {
                    arr.push(1, 2, "string");
                }
                a = pages - curentPage;
                if (a <= 6) {
                    arr.push(
                        curentPage - 4,
                        curentPage - 3,
                        curentPage - 2,
                        curentPage - 1
                    );
                    for (let j = a; j >= 0; j--) {
                        arr.push(pages - j);
                    }
                    if (arr.at(-1) === pages) {
                        break;
                    }
                } else {
                    arr.push(c - 4);
                    c++;
                }
                if (arr.length >= 12) {
                    break;
                }
            } else {
                arr.push(tempt);
                tempt++;
                if (arr.length >= 10) {
                    arr.push("string", pages - 1, pages);
                    break;
                }
            }
        }

        // Set null paginate
        $(paginates).html("");
        if (pages > 1) {
            // Set btn pre
            $(paginates).append(pre);
            $(paginates).append(
                `<input type="hidden" class="curent_page" value="${curentPage}" />`
            );
            arr.forEach((ele) => {
                if (ele != "string") {
                    $(paginates).append(
                        `
                        <li id="page_item" class="page-item page_${ele}"
                        data-id="${ele}">
                            <a class="page-link" >${ele}
                            </a>
                        </li>
                        `
                    );
                } else {
                    $(paginates).append("<p>....</p>");
                }
            });
            // Set btn next
            $(paginates).append(nex);
        }
    }
});

//Format price news
function formatNumber(nStr, decSeperate, groupSeperate) {
    nStr += "";
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + groupSeperate + "$2");
    }
    return x1 + x2;
}

//Paginate
function newPage(array, page_size, page_number) {
    // human-readable page numbers usually start with 1, so we reduce 1 in the first argument
    return array.slice((page_number - 1) * page_size, page_number * page_size);
}
