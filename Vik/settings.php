<?php include("partials/staff/getstaffdata.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings</title>
  
  <?php include("partials/style.html"); ?>
</head>
<body
  x-data="{ page: 'settings', loaded: true, darkMode: true, stickyMenu: false, sidebarToggle: false, scrollTop: false }"
  x-init="
    darkMode = JSON.parse(localStorage.getItem('darkMode'));
    $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
>
<div class="dashboard-container">
  <?php include "partials/preloader.html"; ?>
  <?php include "./partials/sidebar.html"; ?>

  <div>
    <?php include "./partials/header.php"; ?>

    <main>
      <!-- Wrap main content in a centered container with padding -->
      <div class="main-content">
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
          <h2 class="text-title-md2 font-bold dark:text-white text-black">Settings Page</h2>
          <nav>
            <ol class="flex items-center gap-2">
              <li><a class="font-medium" href="admin-dashboard.php">Dashboard /</a></li>
              <li class="font-medium text-primary">Settings</li>
            </ol>
          </nav>
        </div>

        <!-- ====== Settings Section Start -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
          <!-- Personal Information Section (3 columns) -->
          <div class="col-span-1 md:col-span-3">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <div class="border-b border-stroke px-7 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">Personal Information</h3>
              </div>
              
              <div class="p-7">
                <form action="partials/staff/updatestaff.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($staff['id']); ?>">
                  
                  <!-- Form fields remain the same -->
                  <div class="mb-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                      <!-- Name -->
                      <div>
                        <label class="mb-2 block text-sm font-semibold text-black dark:text-white" for="fullName">
                          Full Name
                        </label>
                        <input
                          class="w-full rounded-lg border border-stroke bg-gray
                                 py-2.5 pr-4.5 pl-3 font-medium text-black
                                 focus:border-primary focus:ring-primary/10
                                 dark:border-strokedark dark:bg-boxdark dark:text-white"
                          type="text"
                          name="name"
                          id="fullName"
                          value="<?php echo htmlspecialchars($staff['name']); ?>"
                        />
                      </div>
                      <!-- Phone -->
                      <div>
                        <label class="mb-2 block text-sm font-semibold text-black dark:text-white" for="phoneNumber">
                          Phone Number
                        </label>
                        <input
                          class="w-full rounded-lg border border-stroke bg-gray
                                 py-2.5 pl-3 pr-4.5 font-medium text-black
                                 focus:border-primary focus:ring-primary/10
                                 dark:border-strokedark dark:bg-boxdark dark:text-white"
                          type="text"
                          name="phone_number"
                          id="phoneNumber"
                          value="<?php echo htmlspecialchars($staff['phone_number']); ?>"
                        />
                      </div>
                    </div>
                  </div>

                  <!-- Department -->
                  <div class="mb-4">
                    <label class="mb-2 block text-sm font-semibold text-black dark:text-white" for="departmentSelect">
                      Department
                    </label>
                    <select
                      id="departmentSelect"
                      name="department"
                      class="w-full rounded-lg border border-stroke bg-gray
                             py-2.5 pl-3 pr-4.5 font-medium text-black
                             focus:border-primary focus:ring-primary/10
                             dark:border-strokedark dark:bg-boxdark dark:text-white"
                      onchange="updatePositions('departmentSelect','positionSelect')"
                    >
                      <option value="">Select Department</option>
                      <option value="Sales" <?php if($staff['department']=='Sales') echo 'selected';?>>Sales</option>
                      <option value="Customer Service" <?php if($staff['department']=='Customer Service') echo 'selected';?>>Customer Service</option>
                      <option value="Operations" <?php if($staff['department']=='Operations') echo 'selected';?>>Operations</option>
                      <option value="Design & Development" <?php if($staff['department']=='Design & Development') echo 'selected';?>>Design & Development</option>
                      <option value="Marketing" <?php if($staff['department']=='Marketing') echo 'selected';?>>Marketing</option>
                      <option value="Finance/Administration" <?php if($staff['department']=='Finance/Administration') echo 'selected';?>>Finance/Administration</option>
                      <option value="IT" <?php if($staff['department']=='IT') echo 'selected';?>>IT</option>
                    </select>
                  </div>

                  <!-- Position -->
                  <div class="mb-4">
                    <label class="mb-2 block text-sm font-semibold text-black dark:text-white" for="positionSelect">
                      Position
                    </label>
                    <select
                      id="positionSelect"
                      name="position"
                      class="w-full rounded-lg border border-stroke bg-gray
                             py-2.5 pl-3 pr-4.5 font-medium text-black
                             focus:border-primary focus:ring-primary/10
                             dark:border-strokedark dark:bg-boxdark dark:text-white"
                    >
                      <!-- Populated by JS below -->
                      <option value="">Select Position</option>
                    </select>
                  </div>

                  <!-- Email -->
                  <div class="mb-4">
                    <label class="mb-2 block text-sm font-semibold text-black dark:text-white" for="emailAddress">
                      Email Address
                    </label>
                    <input
                      class="w-full rounded-lg border border-stroke bg-gray
                             py-2.5 pl-3 pr-4.5 font-medium text-black
                             focus:border-primary focus:ring-primary/10
                             dark:border-strokedark dark:bg-boxdark dark:text-white"
                      type="email"
                      name="email"
                      id="emailAddress"
                      value="<?php echo htmlspecialchars($staff['email']); ?>"
                    />
                  </div>

                  <!-- BIO -->
                  <div class="mb-4">
                    <label class="mb-2 block text-sm font-semibold text-black dark:text-white" for="bio">
                      BIO
                    </label>
                    <textarea
                      class="min-h-[100px] w-full rounded-lg border border-stroke bg-gray
                             py-2.5 pl-3 pr-4.5 font-medium text-black
                             focus:border-primary focus:ring-primary/10
                             dark:border-strokedark dark:bg-boxdark dark:text-white"
                      name="bio"
                      id="bio"
                      rows="4"
                    ><?php echo htmlspecialchars($staff['bio']); ?></textarea>
                  </div>

                  <!-- Save Button -->
                  <div class="flex justify-end gap-4">
                    <button 
                      class="button-cancel" 
                      type="button" 
                      onclick="window.location.reload()"
                    >
                      Cancel
                    </button>
                    <button 
                      class="button-save" 
                      type="submit" 
                      name="update_profile"
                    >
                      Save
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Photo Section (2 columns) -->
          <div class="col-span-1 md:col-span-2">
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <div class="border-b border-stroke px-7 py-4 dark:border-strokedark">
                <h3 class="font-medium text-black dark:text-white">Your Photo</h3>
              </div>
              
              <div class="p-7">
                <form action="partials/staff/updatestaff.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo htmlspecialchars($staff['id']); ?>">
                  
                  <!-- Current Photo Display -->
                  <div class="mb-4 flex items-center gap-3">
                    <div class="h-14 w-14 rounded-full">
                      <img id="currentPhoto" 
                           src="<?php echo !empty($staff['photo']) ? 'data:image/jpeg;base64,'.base64_encode($staff['photo']) : './images/user/default.png'; ?>" 
                           alt="User" 
                           class="h-14 w-14 rounded-full object-cover"
                      />
                    </div>
                    <div>
                      <span class="mb-1.5 block text-black dark:text-white">Edit your photo</span>
                      <div class="flex gap-2.5">
                        <button type="submit" name="btn_delete" class="text-sm hover:text-primary">Delete</button>
                        <label for="photo_upload" class="text-sm hover:text-primary cursor-pointer">Update</label>
                      </div>
                    </div>
                  </div>

                  <!-- File Upload Area -->
                  <div class="upload-box relative mb-5.5 block w-full cursor-pointer appearance-none rounded border-2 border-dashed border-primary bg-gray px-4 py-4 dark:bg-meta-4 sm:py-7.5">
                    <input
                      type="file"
                      name="photo"
                      id="photo_upload"
                      accept="image/*"
                      class="absolute inset-0 z-50 m-0 h-full w-full cursor-pointer opacity-0"
                      onchange="previewPhoto(this)"
                    />
                    <div class="flex flex-col items-center justify-center space-y-3">
                      <span class="flex h-10 w-10 items-center justify-center rounded-full border border-stroke bg-white dark:border-strokedark dark:bg-boxdark">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <!-- Upload icon SVG path remains the same -->
                          <path d="M8 0.5C8.27614 0.5 8.5 0.723858 8.5 1V10.2929L11.6464 7.14645C11.8417 6.95118 12.1583 6.95118 12.3536 7.14645C12.5488 7.34171 12.5488 7.65829 12.3536 7.85355L8.35355 11.8536C8.15829 12.0488 7.84171 12.0488 7.64645 11.8536L3.64645 7.85355C3.45118 7.65829 3.45118 7.34171 3.64645 7.14645C3.84171 6.95118 4.15829 6.95118 4.35355 7.14645L7.5 10.2929V1C7.5 0.723858 7.72386 0.5 8 0.5Z" fill="#0F172A"/>
                          <path d="M1 9.5C1.27614 9.5 1.5 9.72386 1.5 10V14.5C1.5 14.7761 1.72386 15 2 15H14C14.2761 15 14.5 14.7761 14.5 14.5V10C14.5 9.72386 14.7239 9.5 15 9.5C15.2761 9.5 15.5 9.72386 15.5 10V14.5C15.5 15.3284 14.8284 16 14 16H2C1.17157 16 0.5 15.3284 0.5 14.5V10C0.5 9.72386 0.723858 9.5 1 9.5Z" fill="#0F172A"/>
                        </svg>
                      </span>
                      <p class="text-sm font-medium">
                        <span class="text-primary">Click to upload</span> or drag and drop
                      </p>
                      <p class="mt-1.5 text-sm font-medium">SVG, PNG, JPG or GIF</p>
                      <p class="text-sm font-medium">(max, 800 X 800px)</p>
                    </div>
                  </div>

                  <!-- Preview Area -->
                  <div id="preview" class="hidden mb-4">
                    <img id="previewImage" src="#" alt="Preview" class="max-w-full h-auto rounded-lg"/>
                  </div>

                  <!-- Action Buttons -->
                  <div class="flex justify-end gap-4">
                    <button type="button" class="button-cancel dark:border-strokedark dark:text-white" onclick="window.location.reload()">
                      Cancel
                    </button>
                    <button type="submit" name="btn_update" class="button-save">
                      Save
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- ====== Settings Section End -->
      </div>
    </main>
  </div>
</div>

<script>
const departmentPositions = {
  "Sales": ["Store Manager","Sales Executive","Sales Assistant","Business Dev Executive","Account Manager"],
  "Customer Service": ["Customer Service Representative","Support Specialist","Returns & Exchanges","Online Chat Specialist","After-Sales Support"],
  "Operations": ["Warehouse Manager","Inventory Coordinator","Logistics Supervisor","Shipping Clerk","Operations Analyst"],
  "Design & Development": ["Product Designer","Industrial Designer","CAD Specialist","Prototype Engineer","R&D Manager"],
  "Marketing": ["Marketing Manager","Social Media Specialist","Visual Merchandiser","Content Creator","Brand Strategist"],
  "Finance/Administration": ["Accountant","Financial Analyst","Bookkeeper","Administrative Assistant","HR Manager"],
  "IT": ["IT Manager","Software Developer","Web Developer","Network Administrator","Technical Support Specialist"]
};

// Pre-fill the position <select> based on dept
function updatePositions(deptId, posId) {
  const deptValue = document.getElementById(deptId).value;
  const posSelect = document.getElementById(posId);

  // Clear
  posSelect.innerHTML = '<option value="">Select Position</option>';

  if (departmentPositions[deptValue]) {
    departmentPositions[deptValue].forEach( pos => {
      let opt = document.createElement('option');
      opt.value = pos;
      opt.textContent = pos;
      // If this matches staff's existing position, pre-select
      if (pos === "<?php echo addslashes($staff['position']); ?>") {
        opt.selected = true;
      }
      posSelect.appendChild(opt);
    });
  }
}

// On load, call updatePositions for the personal info form
document.addEventListener('DOMContentLoaded', () => {
  updatePositions('departmentSelect','positionSelect');
});

// Photo preview
function previewPhoto(input) {
  const previewDiv = document.getElementById('preview');
  const previewImg = document.getElementById('previewImage');
  const currentPhoto = document.getElementById('currentPhoto');

  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = function(e) {
      previewImg.src = e.target.result;
      previewDiv.classList.remove('hidden');
      // Also update the "current photo"
      currentPhoto.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    previewDiv.classList.add('hidden');
  }
}
</script>

<!-- Dark Mode Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const htmlElement = document.documentElement;
    
    // Initialize from localStorage
    const isDark = localStorage.getItem('darkMode') === 'true';
    htmlElement.classList.toggle('dark', isDark);
    
    // Toggle handler
    if(darkModeToggle) {
        darkModeToggle.addEventListener('click', () => {
            const isDarkMode = htmlElement.classList.toggle('dark');
            localStorage.setItem('darkMode', isDarkMode);
            
            // Apply theme colors
            document.querySelectorAll('.dark-theme').forEach(el => {
                el.style.backgroundColor = isDarkMode ? '#23303f' : '';
            });
            document.querySelectorAll('.dark-content').forEach(el => {
                el.style.backgroundColor = isDarkMode ? '#1b222c' : '';
            });
            document.querySelectorAll('input, textarea').forEach(el => {
                el.style.backgroundColor = isDarkMode ? '#313d4a' : '';
            });
        });
    }
});
</script>

<?php include "partials/js.html"; ?>
</body>
</html>
