// Get all elements with class "xdate"
const xdateElements = document.querySelectorAll('.xdate');

// Get the current date
const currentDate = new Date();

// Calculate the date 7 days ago
const sevenDaysAgo = new Date();
sevenDaysAgo.setDate(currentDate.getDate() + 7);

// Loop through each xdate element
xdateElements.forEach(element => {
    const dateText = element.innerHTML;
    const dateValue = new Date(dateText);
    const parentElement = element.parentElement;
    // console.log(parentElement);

    // Compare the date with the current date and 7 days ago
    if (dateValue < currentDate) {
        parentElement.style.backgroundColor = '#E41B17';
    } else if (dateValue <= sevenDaysAgo) {
        parentElement.style.backgroundColor = 'orange';
    }

});

// Assuming you have defined the $ function as shown earlier

$(document).ready(function() {
  // Add a click event handler to the addbtn
  $("#addbtn").click(function() {
    // Toggle the display property of the popup element
    $("#popup").toggle();
  });
  
  $(".closebtn").click(function() {
    // Toggle the display property of the parent element of closebtn
    $(this).parent().toggle();
  });

});

$(document).ready(function() {
  $(".view-icon").click(function(event) {
    event.preventDefault();

    var file_path = $(this).data("path");

    $.ajax({
      type: "GET",
      url: "read_file.php",
      data: { path: file_path },
      success: function(response) {
        $(".preview-container-in").html(response);
        $(".preview-container-in").append("<span class='material-symbols-outlined closebtnn'>close</span>");
        $(".preview-container").show();

         $("main").addClass("blur-background");
      },
      error: function(xhr, status, error) {
        console.error("Error loading preview:", error);
      }
    });
  });

  $(document).on("click", ".closebtnn", function() {
    $("main").removeClass("blur-background");

    $(".preview-container").hide();
    $(".preview-container-in").empty(); // Clear the preview content when closing
  });
});
