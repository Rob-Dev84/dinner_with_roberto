import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

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







// document.addEventListener('DOMContentLoaded', function () {


//   var editButtons = document.querySelectorAll('[data-toggle-reply-form]');

  

//   // Function to handle fetching rating form
//   async function fetchRatingForm() {
//       const ratingContainer = document.getElementById('rating-container');
//       const currentURL = window.location.origin + window.location.pathname;

//       try {
//           let response = await fetch(currentURL + 'partials/_comment-reply-form');
//           let data = await response.text();
//           ratingContainer.innerHTML = data;
//           console.log(data);

       
//       } catch (error) {
//           console.error(error);
//       }
//   }

//   // Iterate through each reply button
//   editButtons.forEach(function (button) {
//       button.addEventListener('click', function () {
          
          
         
    

//           // Call function to fetch rating form
//           fetchRatingForm();
//           // document.getElementById("get_comment_name").textContent = commentName;// output the comment author
//       });
//   });
// });


// document.addEventListener('DOMContentLoaded', function () {

//   var editButtons = document.querySelectorAll('[data-toggle-reply-form]');

// // Function to handle fetching rating form
// async function fetchRatingForm(commentId) {
//     const ratingContainer = document.getElementById('rating-container');

//     const currentURL = window.location.origin + window.location.pathname;

//     try {
//       let response = await fetch(currentURL + 'partials/_comment-reply-form');
//         let data = await response.text();

        
//         // Extract the comment ID from the response
//         const parser = new DOMParser();
//         const doc = parser.parseFromString(data, 'text/html');
//         const commentId = doc.getElementById('comment-id').innerText;

//         // Display the comment ID
//         console.log('Comment ID:', commentId);

//         ratingContainer.innerHTML = data;
//     } catch (error) {
//         console.error(error);
//     }
// }

// editButtons.forEach(function (button) {
//     button.addEventListener('click', function () {
//         // const postId = button.getAttribute('data-post-id');
//         const commentId = button.getAttribute('data-comment-id');
        
//         fetchRatingForm(commentId);
//     });
// });

// });

//GIVES THE RIGHT COMMENT ID
// document.addEventListener('DOMContentLoaded', function () {
//   const editButtons = document.querySelectorAll('[data-toggle-reply-form]');

//   editButtons.forEach(function (button) {
//       button.addEventListener('click', function () {
//           const commentId = button.dataset.commentId;
//           console.log('Comment ID:', commentId);
//           // Now you have the commentId, you can use it as needed, e.g., send it via fetch.
//       });
//   });
// });





// document.addEventListener('DOMContentLoaded', function () {
//   const editButtons = document.querySelectorAll('[data-toggle-reply-form]');

//   editButtons.forEach(function (button) {
//       button.addEventListener('click', function () {
//           const commentId = button.dataset.commentId;

//           const currentURL = window.location.origin + window.location.pathname;
//           // fetch(`/comments/reply/${commentId}`)
//           fetch(currentURL + `partials/_comment-reply-form`)
//               .then(response => response.text())
//               .then(data => {
//                   console.log('Response from /comments/reply:', data);
//                   // Update your UI with the response data as needed
//               })
//               .catch(error => console.error('Error:', error));
//       });
//   });
// });














document.addEventListener('DOMContentLoaded', function () {
  const editButtons = document.querySelectorAll('[data-toggle-reply-form]');

  editButtons.forEach(function (button) {
      button.addEventListener('click', function () {
          const commentId = button.dataset.commentId;

          fetchCommentReplyForm(commentId);
      });
  });
});

async function fetchCommentReplyForm(commentId) {
  const currentURL = window.location.origin + window.location.pathname;
  const response = await fetch(`${currentURL}partials/_comment-reply-form/${commentId}`);
  const data = await response.text();

  // Display the content of the _comment-reply-form in the container
  const commentReplyFormContainer = document.getElementById(`replyFormContainer${commentId}`);
    commentReplyFormContainer.innerHTML = data;

  // Update the comment ID in the loaded content
  const commentContent = document.getElementById('comment-content');
  commentContent.innerHTML = data;
}
