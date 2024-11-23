/**
 * Main
 */

'use strict';

let menu, animate;

(function () {
  // Initialize menu
  //-----------------

  let layoutMenuEl = document.querySelectorAll('#layout-menu');
  layoutMenuEl.forEach(function (element) {
    menu = new Menu(element, {
      orientation: 'vertical',
      closeChildren: false
    });
    // Change parameter to true if you want scroll animation
    window.Helpers.scrollToActive((animate = false));
    window.Helpers.mainMenu = menu;
  });

  // Initialize menu togglers and bind click on each
  let menuToggler = document.querySelectorAll('.layout-menu-toggle');
  menuToggler.forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();
      window.Helpers.toggleCollapsed();
    });
  });

  // Display menu toggle (layout-menu-toggle) on hover with delay
  let delay = function (elem, callback) {
    let timeout = null;
    elem.onmouseenter = function () {
      // Set timeout to be a timer which will invoke callback after 300ms (not for small screen)
      if (!Helpers.isSmallScreen()) {
        timeout = setTimeout(callback, 300);
      } else {
        timeout = setTimeout(callback, 0);
      }
    };

    elem.onmouseleave = function () {
      // Clear any timers set to timeout
      document.querySelector('.layout-menu-toggle').classList.remove('d-block');
      clearTimeout(timeout);
    };
  };
  if (document.getElementById('layout-menu')) {
    delay(document.getElementById('layout-menu'), function () {
      // not for small screen
      if (!Helpers.isSmallScreen()) {
        document.querySelector('.layout-menu-toggle').classList.add('d-block');
      }
    });
  }

  // Display in main menu when menu scrolls
  let menuInnerContainer = document.getElementsByClassName('menu-inner'),
    menuInnerShadow = document.getElementsByClassName('menu-inner-shadow')[0];
  if (menuInnerContainer.length > 0 && menuInnerShadow) {
    menuInnerContainer[0].addEventListener('ps-scroll-y', function () {
      if (this.querySelector('.ps__thumb-y').offsetTop) {
        menuInnerShadow.style.display = 'block';
      } else {
        menuInnerShadow.style.display = 'none';
      }
    });
  }

  // Init helpers & misc
  // --------------------

  // Init BS Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Accordion active class
  const accordionActiveFunction = function (e) {
    if (e.type == 'show.bs.collapse' || e.type == 'show.bs.collapse') {
      e.target.closest('.accordion-item').classList.add('active');
    } else {
      e.target.closest('.accordion-item').classList.remove('active');
    }
  };

  const accordionTriggerList = [].slice.call(document.querySelectorAll('.accordion'));
  const accordionList = accordionTriggerList.map(function (accordionTriggerEl) {
    accordionTriggerEl.addEventListener('show.bs.collapse', accordionActiveFunction);
    accordionTriggerEl.addEventListener('hide.bs.collapse', accordionActiveFunction);
  });

  // Auto update layout based on screen size
  window.Helpers.setAutoUpdate(true);

  // Toggle Password Visibility
  window.Helpers.initPasswordToggle();

  // Speech To Text
  window.Helpers.initSpeechToText();

  // Manage menu expanded/collapsed with templateCustomizer & local storage
  //------------------------------------------------------------------

  // If current layout is horizontal OR current window screen is small (overlay menu) than return from here
  if (window.Helpers.isSmallScreen()) {
    return;
  }

  // If current layout is vertical and current window screen is > small

  // Auto update menu collapsed/expanded based on the themeConfig
  window.Helpers.setCollapsed(true, false);
})();

$(document).ready(function() {
  $('.toggle-status-form button').on('click', function(e) {
      e.preventDefault();
      var form = $(this).closest('form');
      var button = $(this);
      var icon = button.find('i');
      var tooltip = button.find('.tooltip-text');
      var blogId = form.data('blog-id');
      
      $.ajax({
          url: form.attr('action'),
          method: 'POST',
          data: form.serialize(),
          success: function(response) {
              // Cập nhật trạng thái của nút
              if (response.status === 1) {
                  icon.removeClass('fa-eye-slash').addClass('fa-eye');
                  tooltip.text('Active');
                  button.removeClass('text-secondary').addClass('text-primary');
              } else if (response.status === 0) {
                  icon.removeClass('fa-eye').addClass('fa-eye-slash');
                  tooltip.text('Inactive');
                  button.removeClass('text-primary').addClass('text-secondary');
              }

              // Cập nhật trạng thái trong modal
              var modalStatus = $('#modal' + blogId + ' .modal-status');
              if (modalStatus.length) {
                  if (response.status === 1) {
                      modalStatus.removeClass('text-secondary').addClass('text-primary').text('Show');
                  } else {
                      modalStatus.removeClass('text-primary').addClass('text-secondary').text('Hidden');
                  }
              }
          },
          error: function(xhr) {
              console.log('Error:', xhr.responseText);
          }
      });
  });
});
document.querySelectorAll('.delete-btn').forEach(button => {
  button.addEventListener('click', function(event) {
      event.preventDefault(); // Ngăn chặn hành động submit form mặc định
      let blogId = this.getAttribute('data-blog-id');
      Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
      }).then((result) => {
          if (result.isConfirmed) {
              // Gửi form nếu người dùng xác nhận
              document.getElementById('deleteForm_' + blogId).submit();
          }
      });
  });
});
$(document).ready(function () {
  $('.add-to-wishlist-btn').on('click', function () {
      var saleNewsId = $(this).data('sale-news-id'); // Lấy ID của sale_news
      var button = $(this);

      $.ajax({
          url: '/like', // Route đã khai báo ở bước 1
          method: 'POST',
          data: {
              sale_news_id: saleNewsId,
              _token: $('meta[name="csrf-token"]').attr('content'), // Lấy CSRF token
          },
          success: function (response) {
              alert(response.message); // Hiển thị thông báo thành công
              button.text('Đã yêu thích'); // Cập nhật trạng thái nút
              button.prop('disabled', true); // Vô hiệu hóa nút
          },
          error: function (xhr) {
              if (xhr.status === 401) {
                  alert('Vui lòng đăng nhập để sử dụng tính năng này.');
              } else {
                  alert('Có lỗi xảy ra. Vui lòng thử lại.');
              }
          },
      });
  });
});
{/* <div class="sale-news-item">
    <h3></h3>
    <button 
        class="add-to-wishlist-btn" 
        data-sale-news-id="">
        Thêm vào yêu thích
    </button>
</div> */}