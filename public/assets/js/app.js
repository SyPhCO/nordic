


// page gallery
// Get the modal and its components
const modal = document.querySelector(".modal");
const modalImg = document.querySelector(".modal-content");
const closeModal = document.querySelector(".close");

// Get all images in the gallery
const images = document.querySelectorAll(".gallery-item img");



// Add event listeners to each image
images.forEach((image) => {
  image.addEventListener("click", () => {
    // When an image is clicked, set the modal image to the clicked image's source
    modal.style.display = "block";
    modalImg.src = image.src;
  });
});

// When the close button is clicked, hide the modal
closeModal.addEventListener("click", () => {
  modal.style.display = "none";
});

function changePage(idProduct, index) {
  // alert(index);

  $.ajax({
    url: '/updateCommentPageByProduct/' + idProduct + '/' + index, // L'URL de votre route Symfony
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      console.log(response[0])
        // Traitement de la réponse
        console.log(response.message);
    },
    error: function(error) {
      alert("error")
        console.error('Une erreur s\'est produite', error);
    }
});
};

document.addEventListener('DOMContentLoaded', function() {
  var pagination = document.querySelector('.page-link-pagination');
  var comment = pagination.dataset.comment;

  console.log(comment)
});

// promo site voykan

$(document).ready(function(){
  $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
    
    $(".zoom").hover(function(){
		
		$(this).addClass('transition');
	}, function(){
        
		$(this).removeClass('transition');
	});

  
});