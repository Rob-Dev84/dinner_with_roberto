import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


//updated version
//   document.addEventListener('DOMContentLoaded', function () {
//     var editButtons = document.querySelectorAll('[data-toggle-reply-form]');
//     var commentIdInput = document.getElementById('comment_id');
//     var currentVisibleForm = null;
//     var mainCommentForm = document.getElementById('main-comment-form');
//     var computedStyle = window.getComputedStyle(mainCommentForm);

//     // Function to handle fetching rating form
//     async function fetchRatingForm(commentId) {
//         const ratingContainer = document.getElementById('rating-container');
//         const currentURL = window.location.origin + window.location.pathname;

//         try {
//             let response = await fetch(currentURL + 'partials/_rating-comment');
//             let data = await response.text();
//             ratingContainer.innerHTML = data;
//             console.log(data);

//             // Update the action attribute of the form with the correct comment ID
//             const replyForm = document.getElementById('replyForm');
//             replyForm.action = replyForm.action.replace('COMMENT_ID', commentId);
//         } catch (error) {
//             console.error(error);
//         }
//     }

//     // Iterate through each reply button
//     editButtons.forEach(function (button) {
//         button.addEventListener('click', function () {
//             // Get the comment ID and name from data attributes
//             var commentId = button.getAttribute('data-comment-id');
//             // var commentName = button.getAttribute('data-comment-name');
            
//             // if main commment is set on display block, hide it!
//             if (computedStyle.getPropertyValue('display') === 'block') {
//               mainCommentForm.style.display = 'none';
//             }

//         var commentId = button.getAttribute('data-comment-id');
//         // var commentName = button.getAttribute('data-comment-name');
//         var replyFormContainer = document.getElementById('replyFormContainer' + commentId);
//         var replyForm = document.getElementById('form');

//         // Delete the currently visible form, if any
//         if (currentVisibleForm) {
//           currentVisibleForm.remove();
//         }

//         // Set the comment ID and name in the form's hidden inputs
//         commentIdInput.value = commentId;
//         // document.getElementById("get_comment_name").textContent = commentName;// output the comment author

//         // Check if the reply form is already appended, and toggle its visibility
//         if (replyForm) {
//           if (replyForm.style.display === 'none' || replyForm.style.display === '') {
//             replyForm.style.display = 'block';
//             currentVisibleForm = replyForm;
//           } else {
//             replyForm.style.display = 'none';
//             currentVisibleForm = null;

//             // check if main commment is set on diaply none, show it!
//             if (computedStyle.getPropertyValue('display') === 'none') {
//               mainCommentForm.style.display = 'block';
//             }
//           }
//         } 
//         // else {
//         //   // If the reply form doesn't exist, create and append it
//         //   var newForm = document.getElementById('replyForm').cloneNode(true);
//         //   // Update the action attribute of the form with the correct comment ID
//         //   newForm.action = newForm.action.replace('COMMENT_ID', commentId);
//         //   newForm.style.display = 'block';
//         //   replyFormContainer.appendChild(newForm);
//         //   currentVisibleForm = newForm;
//         //   // alert('asdasd');
//         // }



//             // Call function to fetch rating form
//             fetchRatingForm(commentId);
//         });
//     });
// });







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




// Best solution

document.addEventListener('DOMContentLoaded', function () {
  
  
  // scroll to recipe card
  function srollToTarget(buttonAttribute, targetId) {
    const button = document.querySelector(`[${buttonAttribute}]`);
    const target = document.getElementById(targetId);

    if (button && target) {
      button.addEventListener('click', function () {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start',
          inline: 'nearest',
        });
      });
    }
  }
  
  srollToTarget('go-to-recipe-card', 'recipe-card');// Scroll to recipe card
  srollToTarget('go-to-comments', 'main-comment-section');// Scroll to comment section



  function enableNameEmailCommentFields(buttonId, targetId) {
    const button = document.getElementById(buttonId);
    const target = document.getElementById(targetId);

    if (button) {
      button.addEventListener('click', function () {
        target.disabled = false;
        target.style.opacity = '1';
      });
    }
  }

  enableNameEmailCommentFields('enable-name-comment-field', 'name');// Enable input name
  enableNameEmailCommentFields('enable-email-comment-field', 'email');// Enable input email
  

  // Logic to call the comment reply form
  const editButtons = document.querySelectorAll('[data-toggle-reply-form]');

  editButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      const replyCommentContainer = document.getElementById('reply-comment-container');
      
      // If a reply form is already open, remove it
      if (replyCommentContainer) {
        replyCommentContainer.remove();
      }
      
      //TODO: INVERT COMMENT parent/child
      // const commentParentId = button.dataset.commentId;//comment_id wrapped on reply btn (at the moment we don't kmow if it's a parent/child comment) 
      // console.log(commentChildId) = 31 = Pane
      // const commentChildId = button.dataset.commentParentId; // Check if this exists = 30
      
      
      // if reply child button is cliked (only if exists)
      // if (commentParentId) {
      //   var commentId = button.getAttribute('data-comment-parent-id');// reassigned the commentId (because we need to store the commentId parent)
      // }button.dataset
      // console.log(button.dataset);
      //TODO: If parentChildId is null make it the same as the ParentID

      if (button.hasAttribute('data-comment-child-id')) {
        var commentParentId = button.getAttribute('data-comment-parent-id');
        var commentChildId = button.getAttribute('data-comment-child-id');
      } else {
        var commentParentId = button.getAttribute('data-comment-parent-id');
        var commentChildId = button.getAttribute('data-comment-parent-id');
      }
      const commentName = button.dataset.commentName;// grab the comment author name = Pane
    
      
      fetchCommentReplyForm(commentParentId, commentChildId, commentName);
    

      async function fetchCommentReplyForm(commentParentId, commentChildId, commentName) {
        const currentURL = window.location.origin + window.location.pathname;
        const response = await fetch(`${currentURL}/partials/_comment-reply-form/${commentParentId}/${commentChildId}/${commentName}`);
        
        const data = await response.text();
      
        // Check if clicked btn is child and assign the container id for the scroll 
        if (button.hasAttribute('data-comment-child-id')) {// if true the reply btn will be from child comment
          var commentId = button.getAttribute('data-comment-child-id');
        } else {
          var commentId = button.getAttribute('data-comment-parent-id');
        }
        
        const commentReplyFormContainer = document.getElementById(`replyFormContainer${commentId}`);
        commentReplyFormContainer.innerHTML = data;
      
        if (commentReplyFormContainer) {
            // Scroll to the top of the comment container with smooth behavior
            commentReplyFormContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'start',
                inline: 'nearest',
            });
        }
      
      
        // Update the comment ID in the loaded content
        const commentContent = document.getElementById('reply-comment-container');
      
        // Now that the content is loaded, listen for clicks on the cancel button
        const closeCommentReplyForm = document.getElementById("close-comment-reply-form");
      
        if (closeCommentReplyForm) {
          closeCommentReplyForm.addEventListener('click', function () {
            if (commentContent) {
              commentContent.remove();
            }
          });
        }
        
      }
      
    });
  });
});






















