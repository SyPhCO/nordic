// JavaScript for Modal and Slider

// Open the modal
function openModal() {
    document.getElementById('myModal').style.display = 'block';
  }
  
  // Close the modal
  function closeModal() {
    document.getElementById('myModal').style.display = 'none';
  }
  
  // Dynamically add images to the slider
  function populateSlider(images) {
    const sliderContainer = document.querySelector('.slider-container');
  
    images.forEach((imageSrc) => {
      const imgElement = document.createElement('img');
      imgElement.src = imageSrc;
      imgElement.className = 'galeryPict';
      imgElement.addEventListener('click', () => openModal());
      sliderContainer.appendChild(imgElement);
    });
  }
  
  // Get all galeryPict elements and add click event listeners
  const galeryPictElements = document.querySelectorAll('.galeryPict');
  galeryPictElements.forEach((element) => {
    element.addEventListener('click', () => {
      const images = Array.from(element.parentElement.querySelectorAll('.galeryPict'))
                         .map(img => img.src);
      populateSlider(images);
      openModal();
    });
  });