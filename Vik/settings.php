<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Settings</title>
    <!-- CSS only -->
     <?php include("partials/style.html"); ?>
  </head>

  <body
  x-data="{ page: 'settings', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
      darkMode = JSON.parse(localStorage.getItem('darkMode'));
      $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
  ><div class="dashboard-container">
    <!-- ===== Preloader Start ===== -->
    <?php include "partials/preloader.html"; ?>
    <!-- ===== Preloader End ===== -->

      <!-- ===== Sidebar Start ===== -->
      <?php include "./partials/sidebar.html"; ?>
      <!-- ===== Sidebar End ===== -->

      <!-- ===== Content Area Start ===== -->>
      <div
      >
       <!-- ===== Header Start ===== -->
        <?php include "./partials/header.php"; ?>
        <!-- ===== Header End ===== -->

        <!-- ===== Main Content Start ===== -->
        <main>
          <div class="main-content">
              <!-- Breadcrumb Start -->
              <div
                class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
              >
                <h2 class="text-title-md2 font-bold dark:text-white text-black  page-title">
                  Settings Page
                </h2>
                <nav>
                  <ol class="flex items-center gap-2">
                    <li>
                      <a class="font-medium" href="admin-dashboard.php">Dashboard /</a>
                    </li>
                    <li class="font-medium text-primary">Settings</li>
                  </ol>
                </nav>
              </div>
              <!-- Breadcrumb End -->

              <!-- ====== Settings Section Start -->
              <div class="grid grid-cols-5 gap-8">
                <div class="col-span-5 xl:col-span-3">
                  <!-- Personal Information Section -->
                  <div
                    class="personal-info-section rounded-sm border border-stroke bg-white shadow-default"
                  >
                    <div
                      class="personal-info-header border-b border-stroke px-7 py-4 dark:bg-boxdark dark:border-transparent"
                    >
                      <h3 class="personal-info-title font-medium dark:text-white text-black ">
                        Personal Information
                      </h3>
                    </div>
                    <div class="p-7 dark:bg-boxdark">
                      <?php
                      // Get current staff information
                      if (isset($_SESSION['email'])) {
                          $email = $_SESSION['email'];
                          $stmt = $conn->prepare("SELECT * FROM staff WHERE email = ?");
                          $stmt->bind_param("s", $email);
                          $stmt->execute();
                          $staff = $stmt->get_result()->fetch_assoc();
                      } else {
                          header("Location: admin.php");
                          exit();
                      }
                      ?>
                      <form class="form-field-spacing" action="partials/staff/updatestaff.php" method="POST" enctype="multipart/form-data">
                        <!-- Add hidden id field required by updatestaff.php -->
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($staff['id']); ?>">
                        
                        <!-- Form fields with consistent spacing -->
                        <div class="mb-4">
                          <!-- Full Name and Phone Number group -->
                          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <!-- Full Name Field -->
                            <div>
                              <label
                                class="mb-2 block text-sm font-semibold text-black dark:text-white"
                                for="fullName"
                                >Full Name</label
                              >
                              <div class="relative">
                                <input
                                  class="w-full rounded-lg border border-stroke bg-gray py-2.5 pr-4.5 pl-9 font-medium text-black focus:border-primary focus-ring-2 focus:ring-primary/10 dark:border-strokedark dark:bg-boxdark dark:text-white""
                                  type="text"
                                  name="name"
                                  id="fullName"
                                  placeholder=""
                                  value="<?php echo htmlspecialchars($staff['name']); ?>"
                                />
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center fill-current">
                                  <!-- SVG Icon -->
                                  <svg
                                    class="fill-current h-5 w-5"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                  >
                                    <g opacity="0.8">
                                      <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M3.72039 12.887C4.50179 12.1056 5.5616 11.6666 6.66667 11.6666H13.3333C14.4384 11.6666 15.4982 12.1056 16.2796 12.887C17.061 13.6684 17.5 14.7282 17.5 15.8333V17.5C17.5 17.9602 17.1269 18.3333 16.6667 18.3333C16.2064 18.3333 15.8333 17.9602 15.8333 17.5V15.8333C15.8333 15.1703 15.5699 14.5344 15.1011 14.0655C14.6323 13.5967 13.9964 13.3333 13.3333 13.3333H6.66667C6.00363 13.3333 5.36774 13.5967 4.8989 14.0655C4.43006 14.5344 4.16667 15.1703 4.16667 15.8333V17.5C4.16667 17.9602 3.79357 18.3333 3.33333 18.3333C2.8731 18.3333 2.5 17.9602 2.5 17.5V15.8333C2.5 14.7282 2.93899 13.6684 3.72039 12.887Z"
                                        fill=""
                                      />
                                      <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M9.99967 3.33329C8.61896 3.33329 7.49967 4.45258 7.49967 5.83329C7.49967 7.214 8.61896 8.33329 9.99967 8.33329C11.3804 8.33329 12.4997 7.214 12.4997 5.83329C12.4997 4.45258 11.3804 3.33329 9.99967 3.33329ZM5.83301 5.83329C5.83301 3.53211 7.69849 1.66663 9.99967 1.66663C12.3009 1.66663 14.1663 3.53211 14.1663 5.83329C14.1663 8.13448 12.3009 9.99996 9.99967 9.99996C7.69849 9.99996 5.83301 8.13448 5.83301 5.83329Z"
                                        fill=""
                                      />
                                    </g>
                                  </svg>
                                </span>
                              </div>
                            </div>

                            <!-- Phone Number Field -->
                            <div>
                              <label
                                class="mb-2 block text-sm font-semibold text-black dark:text-white"
                                for="phoneNumber"
                                >Phone Number</label
                              >
                              <div class="relative">
                                <input
                                  class="w-full rounded-lg border border-stroke bg-gray py-2.5 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-ring-2 focus:ring-primary/10 dark:border-strokedark dark:bg-boxdark dark:text-white"
                                  type="text"
                                  name="phone_number"
                                  id="phoneNumber"
                                  placeholder=""
                                  value="<?php echo htmlspecialchars($staff['phone_number']); ?>"
                                />
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center fill-current">
                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                  </svg>
                                </span>
                              </div>
                            </div>
                          </div>
                        </div>

<!-- ============================= -->
<!-- DEPARTMENT Field -->
<!-- ============================= -->
<div class="mb-4">
  <label
    class="mb-2 block text-sm font-semibold text-black dark:text-white"
    for="departmentSelect"
  >
    Department
  </label>
  <div class="relative">
    <!-- Left Icon -->
    <span class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center fill-current">
      <!-- Example: "Building" icon (Heroicons or your own) -->
      <svg
        class="h-5 w-5"
        width="20"
        height="20"
        viewBox="0 0 20 20"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <g opacity="0.8">
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M2.5 2.5C2.5 2.22386 2.72386 2 3 2H9C9.27614 2 9.5 2.22386 9.5 2.5V6H11.5V2.5C11.5 2.22386 11.7239 2 12 2H17C17.2761 2 17.5 2.22386 17.5 2.5V17.5C17.5 17.7761 17.2761 18 17 18H12C11.7239 18 11.5 17.7761 11.5 17.5V14H9.5V17.5C9.5 17.7761 9.27614 18 9 18H3C2.72386 18 2.5 17.7761 2.5 17.5V2.5ZM4 3V17H8.5V13.5C8.5 13.2239 8.72386 13 9 13H11C11.2761 13 11.5 13.2239 11.5 13.5V17H16V3H12.5V6.5C12.5 6.77614 12.2761 7 12 7H9C8.72386 7 8.5 6.77614 8.5 6.5V3H4ZM5.5 5C5.5 4.72386 5.72386 4.5 6 4.5H7C7.27614 4.5 7.5 4.72386 7.5 5V6C7.5 6.27614 7.27614 6.5 7 6.5H6C5.72386 6.5 5.5 6.27614 5.5 6V5Z"
            fill="currentColor"
          />
        </g>
      </svg>
    </span>
    
    <!-- The <select> itself -->
    <select
      id="departmentSelect"
      name="department"
      onchange="updatePositions('departmentSelect','positionSelect')"
      class="appearance-none w-full rounded-lg border border-stroke
             bg-gray py-2.5 pl-9 pr-10 font-medium text-black
             focus:border-primary focus:ring-2 focus:ring-primary/10
             dark:border-strokedark dark:bg-boxdark dark:text-white fill-current"
    >
      <option value="">Select Department</option>
      <option value="Sales" <?= ($staff['department'] === 'Sales') ? 'selected' : '' ?>>Sales</option>
      <option value="Customer Service" <?= ($staff['department'] === 'Customer Service') ? 'selected' : '' ?>>Customer Service</option>
      <option value="Operations" <?= ($staff['department'] === 'Operations') ? 'selected' : '' ?>>Operations</option>
      <option value="Design & Development" <?= ($staff['department'] === 'Design & Development') ? 'selected' : '' ?>>Design &amp; Development</option>
      <option value="Marketing" <?= ($staff['department'] === 'Marketing') ? 'selected' : '' ?>>Marketing</option>
      <option value="Finance/Administration" <?= ($staff['department'] === 'Finance/Administration') ? 'selected' : '' ?>>Finance/Administration</option>
      <option value="IT" <?= ($staff['department'] === 'IT') ? 'selected' : '' ?>>IT</option>
    </select>

    <!-- Right Chevron Icon -->
    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 fill-current">
      <svg
        class="h-5 w-5"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          fill-rule="evenodd"
          d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06
             a.75.75 0 011.08 1.04l-4.25 4.65
             a.75.75 0 01-1.08 0L5.25 8.27
             a.75.75 0 01-.02-1.06z"
          clip-rule="evenodd"
        />
      </svg>
    </span>
  </div>
</div>

<!-- ============================= -->
<!-- POSITION Field -->
<!-- ============================= -->
<div class="mb-4">
  <label
    class="mb-2 block text-sm font-semibold text-black dark:text-white"
    for="positionSelect"
  >
    Position
  </label>
  <div class="relative">
    <!-- Left Icon -->
    <span class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center fill-current">
      <!-- Example "Briefcase" icon -->
      <svg
        class="h-5 w-5"
        width="20"
        height="20"
        viewBox="0 0 20 20"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <g opacity="0.8">
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M7 4V3C7 2.17157 7.67157 1.5 8.5 1.5H11.5C12.3284 1.5 13 2.17157 13 3V4H15.5C16.3284 4 17 4.67157 17 5.5V7C17 7.77614 16.7761 8.5 16 8.5H4C3.22386 8.5 3 7.77614 3 7V5.5C3 4.67157 3.67157 4 4.5 4H7ZM9 3C8.72386 3 8.5 3.22386 8.5 3.5V4H11.5V3.5C11.5 3.22386 11.2761 3 11 3H9ZM3 10.5C3 9.67157 3.67157 9 4.5 9H16C16.8284 9 17.5 9.67157 17.5 10.5V15.5C17.5 16.3284 16.8284 17 16 17H4.5C3.67157 17 3 16.3284 3 15.5V10.5Z"
            fill="currentColor"
          />
        </g>
      </svg>
    </span>

    <!-- The <select> for position -->
    <select
      id="positionSelect"
      name="position"
      class="appearance-none w-full rounded-lg border border-stroke
             bg-gray py-2.5 pl-9 pr-10 font-medium text-black
             focus:border-primary focus:ring-2 focus:ring-primary/10
             dark:border-strokedark dark:bg-boxdark dark:text-white fill-current"
    >
      <!-- Populated by updatePositions() -->
      <option value="">Select Position</option>
    </select>

    <!-- Right Chevron Icon -->
    <span class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 fill-current">
      <svg
        class="h-5 w-5"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          fill-rule="evenodd"
          d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06
             a.75.75 0 011.08 1.04l-4.25 4.65
             a.75.75 0 01-1.08 0L5.25 8.27
             a.75.75 0 01-.02-1.06z"
          clip-rule="evenodd"
        />
      </svg>
    </span>
  </div>
</div>




                        <div class="mb-4">
                          <!-- Email Address Field -->
                          <label
                            class="mb-2 block text-sm font-semibold text-black dark:text-white"
                            for="emailAddress"
                            >Email Address</label
                          >
                          <div class="relative">
                            <input
                              class="w-full rounded-lg border border-stroke bg-gray py-2.5 pl-9 pr-4.5 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-boxdark dark:text-white dark:focus:border-primary"
                              type="email"
                              name="email"
                              id="emailAddress"
                              placeholder=""
                              value="<?php echo htmlspecialchars($staff['email']); ?>"
                            />
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center">
                              <!-- SVG Icon -->
                              <svg
                                class="fill-current h-5 w-5"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <g opacity="0.8">
                                  <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M3.33301 4.16667C2.87658 4.16667 2.49967 4.54357 2.49967 5V15C2.49967 15.4564 2.87658 15.8333 3.33301 15.8333H16.6663C17.1228 15.8333 17.4997 15.4564 17.4997 15V5C17.4997 4.54357 17.1228 4.16667 16.6663 4.16667H3.33301ZM0.833008 5C0.833008 3.6231 1.9561 2.5 3.33301 2.5H16.6663C18.0432 2.5 19.1663 3.6231 19.1663 5V15C19.1663 16.3769 18.0432 17.5 16.6663 17.5H3.33301C1.9561 17.5 0.833008 16.3769 0.833008 15V5Z"
                                    fill=""
                                  />
                                  <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M0.983719 4.52215C1.24765 4.1451 1.76726 4.05341 2.1443 4.31734L9.99975 9.81615L17.8552 4.31734C18.2322 4.05341 18.7518 4.1451 19.0158 4.52215C19.2797 4.89919 19.188 5.4188 18.811 5.68272L10.4776 11.5161C10.1907 11.7169 9.80879 11.7169 9.52186 11.5161L1.18853 5.68272C0.811486 5.4188 0.719791 4.89919 0.983719 4.52215Z"
                                    fill=""
                                  />
                                </g>
                              </svg>
                            </span>
                          </div>
                        </div>

                        <div class="mb-4">
                          <!-- BIO Textarea -->
                          <label
                            class="mb-2 block text-sm font-semibold text-black dark:text-white"
                            for="bio"
                            >BIO</label
                          >
                          <div class="relative">
                            <textarea
                              class="min-h-[150px] w-full rounded-lg border border-stroke bg-gray py-2.5 pl-9 pr-4.5 font-medium text-black focus:border-primary focus:ring-2 focus:ring-primary/10 focus-visible:outline-none dark:border-strokedark dark:bg-boxdark dark:text-white dark:focus:border-primary"
                              name="bio"
                              id="bio"
                              rows="4"
                              placeholder="Write your bio here"><?php echo htmlspecialchars($staff['bio']); ?></textarea>
                            <span class="absolute left-3 top-3">
                              <!-- SVG Icon -->
                              <svg
                                class="fill-current h-5 w-5 mt-1"
                                width="20"
                                height="20"
                                viewBox="0 0 20 20"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <g
                                  opacity="0.8"
                                  clip-path="url(#clip0_88_10224)"
                                >
                                  <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M1.56524 3.23223C2.03408 2.76339 2.66997 2.5 3.33301 2.5H9.16634C9.62658 2.5 9.99967 2.8731 9.99967 3.33333C9.99967 3.79357 9.62658 4.16667 9.16634 4.16667H3.33301C3.11199 4.16667 2.90003 4.25446 2.74375 4.41074C2.58747 4.56702 2.49967 4.77899 2.49967 5V16.6667C2.49967 16.8877 2.58747 17.0996 2.74375 17.2559C2.90003 17.4122 3.11199 17.5 3.33301 17.5H14.9997C15.2207 17.5 15.4326 17.4122 15.5889 17.2559C15.7452 17.0996 15.833 16.8877 15.833 16.6667V10.8333C15.833 10.3731 16.2061 10 16.6663 10C17.1266 10 17.4997 10.3731 17.4997 10.8333V16.6667C17.4997 17.3297 17.2363 17.9656 16.7674 18.4344C16.2986 18.9033 15.6627 19.1667 14.9997 19.1667H3.33301C2.66997 19.1667 2.03408 18.9033 1.56524 18.4344C1.0964 17.9656 0.833008 17.3297 0.833008 16.6667V5C0.833008 4.33696 1.0964 3.70107 1.56524 3.23223Z"
                                    fill=""
                                  />
                                  <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M16.6664 2.39884C16.4185 2.39884 16.1809 2.49729 16.0056 2.67253L8.25216 10.426L7.81167 12.188L9.57365 11.7475L17.3271 3.99402C17.5023 3.81878 17.6008 3.5811 17.6008 3.33328C17.6008 3.08545 17.5023 2.84777 17.3271 2.67253C17.1519 2.49729 16.9142 2.39884 16.6664 2.39884ZM14.8271 1.49402C15.3149 1.00622 15.9765 0.732178 16.6664 0.732178C17.3562 0.732178 18.0178 1.00622 18.5056 1.49402C18.9934 1.98182 19.2675 2.64342 19.2675 3.33328C19.2675 4.02313 18.9934 4.68473 18.5056 5.17253L10.5889 13.0892C10.4821 13.196 10.3483 13.2718 10.2018 13.3084L6.86847 14.1417C6.58449 14.2127 6.28409 14.1295 6.0771 13.9225C5.87012 13.7156 5.78691 13.4151 5.85791 13.1312L6.69124 9.79783C6.72787 9.65131 6.80364 9.51749 6.91044 9.41069L14.8271 1.49402Z"
                                    fill=""
                                  />
                                </g>
                                <defs>
                                  <clipPath id="clip0_88_10224">
                                    <rect width="20" height="20" fill="white" />
                                  </clipPath>
                                </defs>
                              </svg>
                            </span>
                          </div>
                        </div>

                        

                        <!-- Updated Photo Form Buttons -->
                        <div class="flex justify-end gap-4">
                          <button class="button-cancel" type="button" onclick="window.location.reload();">
                            Cancel
                          </button>
                          <button class="button-save" type="submit" name="update_profile">
                            Save
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- Your Photo Section -->
                <div class="col-span-5 xl:col-span-2">
                  <div
                    class="personal-info-section dark:bg-boxdark dark:border-strokedark rounded-sm border border-stroke bg-white shadow-default"
                  >
                    <div
                      class="personal-info-header dark:bg-boxdark dark:border-strokedark border-b border-stroke px-7 py-4 "
                    >
                      <h3 class="dark:bg-boxdark font-medium text-black dark:text-white">
                        Your Photo
                      </h3>
                    </div>
                    <div class="dark:bg-boxdark p-7 space-y-5.5">
                    <form action="#">
                        <!-- User Photo and Edit Options -->
                        <div class="mb-4 flex items-center gap-3">
                          <div class="h-14 w-14 rounded-full">
                            <img src="./images/user/user-03.png" alt="User" />
                          </div>
                          <div>
                            <span
                                class="mb-1.5 font-medium text-black dark:text-white dark:dark-input-bg"
                              >Edit your photo</span
                            >
                            <span class="flex gap-2.5">
                                <button
                                class="text-sm font-medium hover:text-primary"
                                >
                                Delete
                              </button>
                              <button
                                class="text-sm font-medium hover:text-primary"
                              >
                                Update
                              </button>
                            </span>
                          </div>
                        </div>

                        <!-- File Upload Section -->
                        <div
                          id="FileUpload"
                          class="upload-box relative mb-5.5 block w-full cursor-pointer appearance-none rounded px-4 py-4  dark:bg-meta-4 sm:py-7.5"
                        >
                          <input
                            type="file"
                            accept="image/*"
                            class="absolute inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none"
                          />
                          <div
                            class="flex flex-col items-center justify-center space-y-3"
                          >
                            <span
                              class="flex h-10 w-10 items-center justify-center rounded-full border border-stroke bg-white dark:border-strokedark dark:bg-boxdark"
                            >
                              <!-- SVG Icon -->
                              <svg
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M1.99967 9.33337C2.36786 9.33337 2.66634 9.63185 2.66634 10V12.6667C2.66634 12.8435 2.73658 13.0131 2.8616 13.1381C2.98663 13.2631 3.1562 13.3334 3.33301 13.3334H12.6663C12.8431 13.3334 13.0127 13.2631 13.1377 13.1381C13.2628 13.0131 13.333 12.8435 13.333 12.6667V10C13.333 9.63185 13.6315 9.33337 13.9997 9.33337C14.3679 9.33337 14.6663 9.63185 14.6663 10V12.6667C14.6663 13.1971 14.4556 13.7058 14.0806 14.0809C13.7055 14.456 13.1968 14.6667 12.6663 14.6667H3.33301C2.80257 14.6667 2.29387 14.456 1.91879 14.0809C1.54372 13.7058 1.33301 13.1971 1.33301 12.6667V10C1.33301 9.63185 1.63148 9.33337 1.99967 9.33337Z"
                                  fill="#3C50E0"
                                />
                                <path
                                  fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M7.5286 1.52864C7.78894 1.26829 8.21106 1.26829 8.4714 1.52864L11.8047 4.86197C12.0651 5.12232 12.0651 5.54443 11.8047 5.80478C11.5444 6.06513 11.1223 6.06513 10.8619 5.80478L8 2.94285L5.13807 5.80478C4.87772 6.06513 4.45561 6.06513 4.19526 5.80478C3.93491 5.54443 3.93491 5.12232 4.19526 4.86197L7.5286 1.52864Z"
                                  fill="#3C50E0"
                                />
                                <path
                                  fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M7.99967 1.33337C8.36786 1.33337 8.66634 1.63185 8.66634 2.00004V10C8.66634 10.3682 8.36786 10.6667 7.99967 10.6667C7.63148 10.6667 7.33301 10.3682 7.33301 10V2.00004C7.33301 1.63185 7.63148 1.33337 7.99967 1.33337Z"
                                  fill="#3C50E0"
                                />
                              </svg>
                            </span>
                            <p class="text-sm font-medium">
                              <span class="text-primary">Click to upload</span>
                              or drag and drop
                            </p>
                            <p class="mt-1.5 text-sm font-medium">
                              SVG, PNG, JPG or GIF
                            </p>
                            <p class="text-sm font-medium">
                              (max, 800 X 800px)
                            </p>
                          </div>
                        </div>

                        <!-- Update Photo Form Buttons -->
                        <div class="button-wrapper">
                          <button
                            class="button-cancel dark:border-strokedark dark:text-white"
                            type="submit"
                          >
                            Cancel
                          </button>
                          <button
                            class="button-save"
                            type="submit"
                          >
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
          </div>
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
    </div>
    <script>
  const departmentPositions = {
    "Sales": [
      "Store Manager",
      "Sales Executive",
      "Sales Assistant",
      "Business Development Executive",
      "Account Manager"
    ],
    "Customer Service": [
      "Customer Service Representative",
      "Support Specialist",
      "Returns & Exchanges Coordinator",
      "Online Chat Specialist",
      "After-Sales Support Specialist"
    ],
    "Operations": [
      "Warehouse Manager",
      "Inventory Coordinator",
      "Logistics Supervisor",
      "Shipping & Receiving Clerk",
      "Operations Analyst"
    ],
    "Design & Development": [
      "Product Designer",
      "Industrial Designer",
      "CAD Specialist",
      "Prototype Engineer",
      "R&D Manager"
    ],
    "Marketing": [
      "Marketing Manager",
      "Social Media Specialist",
      "Visual Merchandiser",
      "Content Creator",
      "Brand Strategist"
    ],
    "Finance/Administration": [
      "Accountant",
      "Financial Analyst",
      "Bookkeeper",
      "Administrative Assistant",
      "HR Manager"
    ],
    "IT": [
      "IT Manager",
      "Software Developer",
      "Web Developer",
      "Network Administrator",
      "Technical Support Specialist"
    ]
  };

  function updatePositions(deptSelectId, positionSelectId) {
    const dept = document.getElementById(deptSelectId).value;
    const posSelect = document.getElementById(positionSelectId);
    // Clear existing options
    posSelect.innerHTML = '<option value="">Select Position</option>';

    // If there's a matching department, populate its positions
    if (departmentPositions[dept]) {
      departmentPositions[dept].forEach(pos => {
        const option = document.createElement('option');
        option.value = pos;
        option.textContent = pos;
        // If the staff had a saved position, set it as selected
        if (pos === "<?php echo addslashes($staff['position']); ?>") {
          option.selected = true;
        }
        posSelect.appendChild(option);
      });
    }
  }

  // On page load, trigger it once so position is pre-filled if editing
  window.addEventListener('DOMContentLoaded', () => {
    updatePositions('departmentSelect','positionSelect');
  });
</script>

  </body>
  <?php include "partials/js.html";?>
</html>
