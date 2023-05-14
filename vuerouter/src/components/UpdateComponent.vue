<template>
  <div>
    <div class="alert alert-success" role="alert" v-if="elertMassage">
      User Created Successfully !
    </div>

    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align: center; margin-top: 40px">
      <span
        class="step m-3 p-4"
        :class="step == 0 ? ' bg-primary' : 'bg-dark'"
      ></span>
      <span
        class="step m-3 p-4"
        :class="step == 1 ? ' bg-primary' : 'bg-dark'"
      ></span>
      <span
        class="step m-3 p-4"
        :class="step == 2 ? ' bg-primary' : 'bg-dark'"
      ></span>
    </div>
    <h1>
      {{
        this.step == 0
          ? "Genrall information"
          : this.step == 2
          ? "personal information"
          : this.step == 1
          ? "Acount Information"
          : "UnKnown Step"
      }}
    </h1>
    <form id="regForm" action="">
      <!-- One "tab" for each step in the form: -->
      <div class="tab" v-if="step == 0">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">Nationality</label>
              <input
                type="text"
                class="form-control"
                id="country"
                placeholder="Afgan"
                v-model="this.newUser.nationality"
              />
              <span v-if="errors.nationality" class="error text-danger">{{
                errors.nationality[0]
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">Country</label>
              <select
                name="country"
                id="country"
                class="form-control"
                v-model="this.newUser.country"
                placeholder="Country"
              >
                <option disabled value="select country" selected>
                  select Country
                </option>
                <option
                  v-for="country in country"
                  :key="country"
                  :value="country.id"
                >
                  {{ country.name }}
                </option>
              </select>
              <span v-if="errors.country" class="error text-danger">{{
                errors.country[0]
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">Address</label>
              <input
                type="text"
                class="form-control"
                id="country"
                placeholder="kabul , company"
                v-model="this.newUser.Religious"
              /><span v-if="errors.country" class="error text-danger">{{
                errors.Religious[0]
              }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="tab" v-if="step == 1">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">FirstName</label>
              <input
                type="text"
                class="form-control"
                id="country"
                placeholder="Ahmad"
                v-model="this.newUser.first_name"
              />
              <span v-if="errors.first_name" class="error text-danger">{{
                errors.first_name[0]
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">LastName</label>
              <input
                type="text"
                class="form-control"
                id="country"
                placeholder="Last Name"
                v-model="this.newUser.last_name"
              /><span v-if="errors.last_name" class="error text-danger">{{
                errors.last_name[0]
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">UserName</label>
              <input
                type="text"
                class="form-control"
                id="country"
                placeholder="Ahmad98"
                v-model="this.newUser.user_name"
              /><span v-if="errors.user_name" class="error text-danger">{{
                errors.user_name[0]
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">Email</label>
              <input
                type="text"
                class="form-control"
                id="country"
                placeholder="Email@gmail.com"
                v-model="this.newUser.email"
              />
              <span v-if="errors.email" class="error text-danger">{{
                errors.email[0]
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">Phone</label>
              <input
                type="tel"
                id="phone"
                class="form-control phone"
                placeholder="+93999999999"
                v-model="this.newUser.phone"
              />
              <span v-if="errors.phone" class="error text-danger">{{
                errors.phone[0]
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">Whatsapp</label>
              <input
                type="tel"
                id="phone"
                class="form-control phone"
                placeholder="+938888888"
                v-model="this.newUser.whatsapp"
              />
              <span v-if="errors.whatsapp" class="error text-danger">{{
                errors.whatsapp[0]
              }}</span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="flexCheckChecked"
                  checked
                  @change="generatePassword($event)"
                  v-model="this.generatePasswordbtn"
                />
                <label class="form-check-label" for="flexCheckChecked">
                  Automatic Generate Password
                </label>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="country" class="form-label">Password</label>
              <input
                type="text"
                class="form-control"
                id="country"
                placeholder="*******"
                v-model="this.newUser.password"
                :disabled="generatePasswordbtn"
              />
              <span v-if="errors.password" class="error text-danger">{{
                errors.password[0]
              }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="tab" v-if="step == 2">
        <form @submit.prevent="createUser">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">DateOfBirth</label>
              <input
                type="date"
                id="name"
                v-model="newUser.date_of_birth"
                required
                class="form-control"
              />
              <span v-if="errors.date_of_birth" class="error text-danger">{{
                errors.date_of_birth[0]
              }}</span>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Gender</label>
              <select v-model="newUser.gander" class="form-control" required>
                <option disabled value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
              <span v-if="errors.gender" class="error text-danger">{{
                errors.gender[0]
              }}</span>
            </div>
            <div class="mb-3 col-md-6">
              <label for="phone" class="form-label">Health Status</label>
              <select
                class="form-control"
                id="phone"
                placeholder="Enter employee phone number"
                required
                v-model="newUser.healt_status"
              >
                <option disabled value="">Select Health Status</option>
                <option value="1">Normal</option>
                <option value="0">AbNormal</option>
              </select>
              <span v-if="errors.healt_status" class="error text-danger">{{
                errors.healt_status[0]
              }}</span>
            </div>
            <div class="mb-3 col-md-6">
              <label for="address" class="form-label">National Id</label>
              <input
                class="form-control"
                id="address"
                placeholder="Enter employee address"
                required
                v-model="newUser.nid"
              />
              <span v-if="errors.national_id" class="error text-danger">{{
                errors.national_id[0]
              }}</span>
            </div>
            <div class="mb-3 col-md-6">
              <label for="salary" class="form-label">Image</label>
              <input
                type="file"
                id="profileImage"
                @change="handleFileUpload"
                required
                class="form-control"
              />
              <span v-if="errors.profileImage" class="error text-danger">{{
                errors.profileImage[0]
              }}</span>
            </div>
          </div>
        </form>
      </div>

      <div style="overflow: auto">
        <div style="float: right">
          <button
            type="button"
            id="prevBtn"
            @click="step >= 1 ? step-- : ''"
            class="btn btn-info m-1"
          >
            Previous
          </button>

          <button
            type="button"
            id="nextBtn"
            @click="chackRequest"
            :class="
              step <= 1 ? 'btn btn-secondary m-1' : ' btn btn-success m-1'
            "
          >
            Next
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
  
  <script>
import axios from "axios";
import "intl-tel-input/build/css/intlTelInput.css";
export default {
  data() {
    return {
      elertMassage: false,
      generatePasswordbtn: false,
      step: 0,
      title: "Genral Information",
      country: [],
      errors: {},
      newUser: {
        nationality: "",
        country: "",
        Religious: "",
        first_name: "",
        last_name: "",
        user_name: "",
        phone: "",
        address: "",
        email: "",
        profileImage: "",
        date_of_birth: "",
        gander: "",
        whatsapp: "",
        nid: "",
        healt_status: "",
        password: "",
      },
    };
  },
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = (event) => {
        const img = new Image();
        img.onload = () => {
          const canvas = document.createElement("canvas");
          const ctx = canvas.getContext("2d");
          canvas.width = 128;
          canvas.height = 128;
          ctx.drawImage(img, 0, 0, 128, 128);
          canvas.toBlob(
            (blob) => {
              const correctedFile = new File([blob], file.name, {
                type: file.type,
              });
              this.newUser.profileImage = correctedFile;
            },
            file.type,
            1
          );
        };
        img.src = event.target.result;
      };
      reader.readAsDataURL(file);
    },
    createUser() {
      const formData = new FormData();
      formData.append("nationality", this.newUser.nationality);
      formData.append("country", this.newUser.country);
      formData.append("Religious", this.newUser.Religious);
      formData.append("first_name", this.newUser.first_name);
      formData.append("last_name", this.newUser.last_name);
      formData.append("user_name", this.newUser.user_name);
      formData.append("email", this.newUser.email);
      formData.append("phone", this.newUser.phone);
      formData.append("whatsapp", this.newUser.whatsapp);
      formData.append("password", this.newUser.password);
      formData.append("date_of_birth", this.newUser.date_of_birth);
      formData.append("gander", this.newUser.gander);
      formData.append("nid", this.newUser.nid);
      formData.append("healt_status", this.newUser.healt_status);
      formData.append("profileImage", this.newUser.profileImage);
      axios
        .post("http://localhost:8000/api/users/create/", formData)
        .then((response) => {
          this.errors = {};
          this.elertMassage = true;
          this.newUser = {};
          setTimeout(() => {
            console.log(response.data.message);
            this.elertMassage = false;
            this.message = response.data.message;
          }, 5000);
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    chackRequest() {
      if (this.step == 0) {
        const formData = new FormData();
        formData.append("nationality", this.newUser.nationality);
        formData.append("country", this.newUser.country);
        formData.append("Religious", this.newUser.Religious);
        axios
          .post("http://localhost:8000/api/users/chackGenrall/", formData)
          .then((response) => {
            if (response.data.message == true) {
              this.step++;
            }
            this.errors = {};
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
            }
          });
      } else if (this.step == 1) {
        const formData = new FormData();
        formData.append("first_name", this.newUser.first_name);
        formData.append("last_name", this.newUser.last_name);
        formData.append("user_name", this.newUser.user_name);
        formData.append("email", this.newUser.email);
        formData.append("phone", this.newUser.phone);
        formData.append("whatsapp", this.newUser.whatsapp);
        formData.append("password", this.newUser.password);
        axios
          .post("http://localhost:8000/api/users/chackAcount/", formData)
          .then((response) => {
            if (response.data.message == true) {
              this.step++;
            }
            this.errors = {};
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
              console.log(this.errors);
            }
          });
      } else if (this.step == 2) {
        const formData = new FormData();
        formData.append("date_of_birth", this.newUser.date_of_birth);
        formData.append("gander", this.newUser.gander);
        formData.append("healt_status", this.newUser.healt_status);
        formData.append("national_id", this.newUser.nid);
        formData.append("profileImage", this.newUser.profileImage);
        axios
          .post("http://localhost:8000/api/users/chackPersonalInfo/", formData)
          .then((response) => {
            if (response.data.message == true) {
              this.step = 0;
              this.errors = {};
              this.createUser();
            }
          })
          .catch((error) => {
            if (error.response.status === 422) {
              this.errors = error.response.data.errors;
            }
          });
      }
    },

    generatePassword(event) {
      console.log(event.target.value);
      let result = "";
      let characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$/\\";
      let charactersLength = characters.length;
      for (let i = 0; i < 8; i++) {
        result += characters.charAt(
          Math.floor(Math.random() * charactersLength)
        );
      }
      this.newUser.password = result;
    },
  },
  mounted() {
    axios
      .get("http://localhost:8000/api/getCountry")
      .then((response) => {
        this.country = response.data.country;
        console.log(response.data);
        this.errors = {};
      })
      .catch((error) => {
        console.log(error);
      });
     
  },
};
</script>