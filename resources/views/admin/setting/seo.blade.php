@extends('layouts.admin')
@section('content')
<style>
    pre {
        background-color: #282c34;
        color: #f8f8f2;
        padding: 15px;
        border-radius: 8px;
        overflow-x: auto;
    }
    code {
        font-family: 'Courier New', Courier, monospace;
        font-size: 16px;
    }
    .error-message {
        color: red;
    }
    /* Thêm hiệu ứng ban đầu */
#notifications {
    background-color: #282c34;
    display: block;
    width: 100%;
    border-radius: 5px;
    padding-top: 0.4375rem;
    padding-right: 0.875rem;
    padding-bottom: 0.4375rem;
    padding-left: 0.875rem;
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 2rem;
    color: #ffffff;
    white-space: nowrap;
    overflow: hidden;
    box-sizing: border-box;
}
/* #notifications div {
    display: inline-block;
    padding-left: 100%;
    animation: marquee 10s linear infinite;
}
@keyframes marquee {
    0% {
        transform: translateX(0%);
    }
    100% {
        transform: translateX(-100%);
    }
} */
 .running-text {
    white-space: nowrap;
    display: inline-block;
    animation: runningText 10s linear infinite;
}
@keyframes runningText {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(-100%);
    }
}
#notifications {
    overflow: hidden;
    white-space: nowrap;
}




</style>
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-6 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Insert code into source code</h5>
                        <div class="mb-6">
                            <label class="form-label" for="ecommerce-product-name">Name Script</label>
                            <input type="text" class="form-control" id="name_seo" placeholder="source code" aria-label="Name Script">
                            <span class="error-message" id="error-message"></span>
                        </div>
                        <div class="mb-6">
                            <pre><code id="scriptSource"> </code></pre>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="ecommerce-product-name">Script</label>
                            <textarea type="text" class="form-control" id="seo" placeholder="Product title" name="productTitle" aria-label="Product title" oninput="updateScriptSource()"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="saveScriptContent()" id="btn-publish-product">Publish</button>
                    </div>
                </div>
            </div>
             <div class="col-lg-6 mb-4 order-0">
                <div class="card">
                    {{-- <div class="card-body">
                        <h5 class="card-title text-primary">List of inserted codes</h5>
                        <div id="scriptList" class="accordion"></div> <!-- Nơi hiển thị các mã đã chèn -->
                    </div> --}}
                    <div class="card-body">
                        <h5 class="card-title text-primary">Floating notifications</h5>

                        <div class="mb-6">
                            <div
                             id="notifications"></div>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="ecommerce-product-name">Notifications</label>
                            <textarea type="text" class="form-control" id="note" placeholder="notifications" name="productTitle" aria-label="Product title" ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="uploadNotification()" >Publish</button>
                    </div>
                </div>
             </div>
        </div>
        <div class="row">
             <div class="col-lg-6 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">List of inserted codes</h5>
                        <div id="scriptList" class="accordion"></div>
                    </div>
                </div>
             </div>
        </div>

    </div>
@endsection

@section('script-link-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/dropzone/dropzone.css">
<script src="{{ asset('admin/assets/js/pages-account-settings-account.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Đảm bảo tải SweetAlert2 -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notifications = document.getElementById("notifications");
         const marqueeText = document.createElement("div");
         marqueeText.innerText = notifications.innerText; notifications.innerHTML = '';
          notifications.appendChild(marqueeText);
          });
</script>




<script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

    function uploadNotification() {
        var  note = document.getElementById("note").value;
        var data = {
         "Floating-notifications": note,

        };
        // console.log(data);

        fetch("{{  route('saveNotification') }}", {
        method: "POST",
        headers: { "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content") },
          body: JSON.stringify(data) })
            .then((response) => response.json())
            .then((data) =>{
                  if (data.alert) {
                Toast.fire({
                    icon: data.alert.type,
                    title: data.alert.message
                });}
                note.innerHTML = '';
                fetchNotifications();



            })
            .catch((error) => {
                console.error("Lỗi:", error);
            });
    }

    function fetchNotifications() {
    fetch("{{ route('getnotification') }}")
        .then((response) => response.json())
        .then((data) => {
            const notificationsDiv = document.getElementById("notifications");
            notificationsDiv.innerHTML = '';

            if (data['Floating-notifications']) {
                notificationsDiv.innerHTML += `<span class="running-text">${data['Floating-notifications']}</span>`;
            } else {
                notificationsDiv.innerHTML = '<p>There are no announcements.</p>';
            }
        })
        .catch((error) => {
            console.error("Lỗi:", error);
        });
}





    function updateScriptSource() {
        var inputValue = document.getElementById("seo").value;
        var scriptContent =  inputValue ;
        document.getElementById("scriptSource").innerText = scriptContent;
    }

    function saveScriptContent() {
        var scriptContent = document.getElementById("seo").value;
        var scriptName = document.getElementById("name_seo").value;

        var formData = new FormData();
        formData.append('name', scriptName);
        formData.append('script', scriptContent);

        fetch("{{ route('saveScript') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("error-message").innerText = '';
            document.getElementById("seo").value = '';
            document.getElementById("name_seo").value = '';
            updateScriptSource();
            if (data.alert) {
                Toast.fire({
                    icon: data.alert.type,
                    title: data.alert.message
                });
                loadScripts(); // Cập nhật danh sách mã sau khi lưu thành công
            } else {
                throw new Error(data.error || 'Unknown error');
            }
        })
        .catch(error => {
            console.error("Error saving script:", error);
            document.getElementById("error-message").innerText = error.message;
            Toast.fire({
                icon: 'error',
                title: error.message
            });
        });
    }

  function loadScripts() {
    fetch("{{ route('getScripts') }}")
        .then(response => response.json())
        .then(data => {
            const scriptList = document.getElementById("scriptList");
            scriptList.innerHTML = ""; // Xóa nội dung cũ

            data.forEach((script, index) => {
                // Tạo phần tử accordion
                const accordionItem = document.createElement("div");
                accordionItem.classList.add("accordion-item");

                // Tạo phần tiêu đề
                const accordionHeader = document.createElement("h2");
                accordionHeader.classList.add("accordion-header");
                accordionHeader.id = `heading${index}`;

                const accordionButton = document.createElement("button");
                accordionButton.classList.add("accordion-button", "collapsed");
                accordionButton.type = "button";
                accordionButton.setAttribute("data-bs-toggle", "collapse");
                accordionButton.setAttribute("data-bs-target", `#collapse${index}`);
                accordionButton.setAttribute("aria-expanded", "false");
                accordionButton.setAttribute("aria-controls", `collapse${index}`);
                accordionButton.innerHTML = `
                     ${script.name}
                    <button class="btn btn-danger btn-sm ms-3" onclick="deleteScript('${script.name}')">Delete</button>
                `;

                // Tạo phần collapse
                const accordionCollapse = document.createElement("div");
                accordionCollapse.id = `collapse${index}`;
                accordionCollapse.classList.add("accordion-collapse", "collapse");
                accordionCollapse.setAttribute("aria-labelledby", `heading${index}`);
                accordionCollapse.setAttribute("data-bs-parent", "#scriptList");

                const accordionBody = document.createElement("div");
                accordionBody.classList.add("accordion-body");
                // accordionBody.innerText = `<pre><code>${script.script}</code></pre>`;
                const pre = document.createElement("pre");
                 const code = document.createElement("code");
                  code.innerText = `${script.script}`;
                pre.appendChild(code);
                accordionBody.appendChild(pre);

                accordionHeader.appendChild(accordionButton);
                accordionCollapse.appendChild(accordionBody);
                accordionItem.appendChild(accordionHeader);
                accordionItem.appendChild(accordionCollapse);

                // Thêm vào danh sách
                scriptList.appendChild(accordionItem);
            });
        })
        .catch(error => {
            console.error("Error loading scripts:", error);
        });
}


    function deleteScript(name) {
        fetch("{{ route('deleteScript') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name: name })
        })
        .then(response => response.json())
        .then(data => {
            if (data.alert) {
                Toast.fire({
                    icon: data.alert.type,
                    title: data.alert.message
                });
                loadScripts(); // Cập nhật danh sách mã sau khi xóa thành công
            } else {
                throw new Error(data.error || 'Unknown error');
            }
        })
        .catch(error => {
            console.error("Error deleting script:", error);
            Toast.fire({
                icon: 'error',
                title: error.message
            });
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        loadScripts();
        fetchNotifications();
         // Tải danh sách mã khi trang được tải
    });
</script>

@endsection
