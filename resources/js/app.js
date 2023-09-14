import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Alpine.data('commentsState', () => ({
//     showReplyForm: {},
//     toggleReplyForm(commentId) {
//         this.$set(this.showReplyForm, commentId, !this.showReplyForm[commentId]);
//     },
//     scrollReplyForm(commentId) {
//         const containerId = `reply-form-container-${commentId}`;
//         const containerElement = document.getElementById(containerId);

//         if (containerElement) {
//             // Scroll to the top of the container with smooth behavior
//             containerElement.scrollIntoView({
//                 behavior: 'smooth',
//                 block: 'start',
//                 inline: 'nearest',
//             });
//         }
//     },
// }));


// function setup() {
//     return {
//         showReplyForm: false,
//         commentId: null,
//         setCommentId(id) {
//             this.commentId = id;
//         },
//         // Rest of your JavaScript code
//     }
// }


Alpine.start();



  document.addEventListener('DOMContentLoaded', function () {
    var editButtons = document.querySelectorAll('[data-toggle-reply-form]');
    var commentIdInput = document.getElementById('comment_id');
    var currentVisibleForm = null;

    var mainCommentForm = document.getElementById('main-comment-form');
    var computedStyle = window.getComputedStyle(mainCommentForm);

    editButtons.forEach(function (button) {
      button.addEventListener('click', function () {

        // if main commment is set on diaply block, hide it!
        if (computedStyle.getPropertyValue('display') === 'block') {
          mainCommentForm.style.display = 'none';
        }

        var commentId = button.getAttribute('data-comment-id');
        var replyFormContainer = document.getElementById('replyFormContainer' + commentId);
        var replyForm = replyFormContainer.querySelector('form');

        // Delete the currently visible form, if any
        if (currentVisibleForm) {
          // currentVisibleForm.style.display = 'none';
          currentVisibleForm.remove();
        }

        // Update the hidden input with the comment ID
        commentIdInput.value = commentId;

        // Check if the reply form is already appended, and toggle its visibility
        if (replyForm) {
          if (replyForm.style.display === 'none' || replyForm.style.display === '') {
            replyForm.style.display = 'block';
            currentVisibleForm = replyForm;
          } else {
            replyForm.style.display = 'none';
            currentVisibleForm = null;

            // check if main commment is set on diaply none, show it!
            if (computedStyle.getPropertyValue('display') === 'none') {
              mainCommentForm.style.display = 'block';
            }
          }
        } else {
          // If the reply form doesn't exist, create and append it
          var newForm = document.getElementById('replyForm').cloneNode(true);
          // Update the action attribute of the form with the correct comment ID
          newForm.action = newForm.action.replace('COMMENT_ID', commentId);
          newForm.style.display = 'block';
          replyFormContainer.appendChild(newForm);
          currentVisibleForm = newForm;
        }
      });
    });
  });


  