<template>
  <div class="max-w-full mx-auto p-4 bg-gray-100 min-h-screen">
    <div class="flex flex-col lg:flex-row gap-4">
      
      <div class="lg:w-1/2 bg-white p-6 rounded-xl shadow-lg h-[90vh] overflow-y-auto">
        <div class="text-center mb-8">
          <h3 class="text-lg font-semibold text-gray-600">Republic of the Philippines</h3>
          <h1 class="text-2xl font-bold text-gray-900">Position Description Form</h1>
          <h4 class="text-md font-medium text-gray-700">DBM-CSC Form No.1</h4>
          <h6 class="text-sm text-gray-500">(Revised Version No.1, s.2017)</h6>
        </div>

        <form @submit.prevent class="space-y-6">
          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <div class="grid md:grid-cols-1 gap-4">
              <div>
                <label class="block mb-2 font-medium">1. POSITION TITLE <label class="text-xs">(as approved by authorized agency) with parenthetical title.</label></label>
                <input v-model="form.positionTitle" type="text" class="w-full border rounded px-3 py-2"/>
              </div>
              <div>
                <label class="block mb-1 font-medium">3. SALARY GRADE</label>
                <input v-model="form.salaryGrade" type="text" class="w-full border rounded px-3 py-2"/>
              </div>
            </div>
            <div class="mt-4">
              <label class="block mb-2 font-semibold">4. FOR LOCAL GOVERNMENT POSITION, ENUMERATE GOVERNMENTAL UNIT AND CLASS</label>
              <div class="flex flex-wrap gap-2 mb-2">
                <label class="flex items-center gap-1"><input type="checkbox" v-model="form.lgProvince" /> Province</label>
                <label class="flex items-center gap-1"><input type="checkbox" v-model="form.lgCity" /> City</label>
                <label class="flex items-center gap-1"><input type="checkbox" v-model="form.lgMunicipality" /> Municipality</label>
              </div>
              <div class="flex flex-wrap gap-2">
                <label v-for="n in 6" :key="n" class="flex items-center gap-1"><input type="checkbox" v-model="form['class'+n]" /> {{n}}th Class</label>
                <label class="flex items-center gap-1"><input type="checkbox" v-model="form.classSpecial" /> Special</label>
              </div>
            </div>
          </div>

          <div class="border p-4 rounded-lg shadow-sm bg-white grid md:grid-cols-2 gap-4">
            <div><label class="block mb-1 text-sm font-medium">5. DEPARTMENT, CORPORATION OR AGENCY/ LOCAL GOVERNMENT</label><input v-model="form.department" type="text" class="w-full border rounded px-3 py-2"/></div>
            <div><label class="block mb-1 font-medium">6. BUREAU OR OFFICE</label><input v-model="form.bureau" type="text" class="w-full border rounded px-3 py-2"/></div>
            <div><label class="block mb-1 font-medium">7. BRANCH/BRANCH/DIVISION</label><input v-model="form.branch" type="text" class="w-full border rounded px-3 py-2"/></div>
            <div><label class="block mb-1 font-medium">8. WORKSTATION/ PLACE OF WORK</label><input v-model="form.workstation" type="text" class="w-full border rounded px-3 py-2"/></div>
          </div>

          <div class="border p-4 rounded-lg shadow-sm bg-white grid md:grid-cols-2 gap-4">
            <div><label class="block mb-1 font-medium">9. PRESENT APPROP ACT</label><input v-model="form.presentAppropriation" type="text" class="w-full border rounded px-3 py-2"/></div>
            <div><label class="block mb-1 font-medium">10. PREVIOUS APPROP ACT</label><input v-model="form.previousAppropriation" type="text" class="w-full border rounded px-3 py-2"/></div>
            <div><label class="block mb-1 font-medium">11. SALARY AUTHORIZED</label><input v-model="form.salaryAuthorized" type="text" class="w-full border rounded px-3 py-2"/></div>
            <div><label class="block mb-1 font-medium">12. OTHER COMPENSATION</label><input v-model="form.otherCompensation" type="text" class="w-full border rounded px-3 py-2"/></div>
          </div>

          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <div class="grid md:grid-cols-2 gap-4 mb-4">
              <div><label class="block mb-1 font-medium">13. POSITION TITLE OF IMMEDIATE SUPERVISOR</label><input v-model="form.immediateSupervisor" type="text" class="w-full border rounded px-3 py-2"/></div>
              <div><label class="block mb-1 font-medium">14. POSITION TITLE OF NEXT HIGHER SUPERVISOR</label><input v-model="form.nextSupervisor" type="text" class="w-full border rounded px-3 py-2"/></div>
            </div>
            <label class="block mb-2 font-medium">15. DIRECTLY SUPERVISED<label class=" text-xs"> (if more than seven(7) list only by their item numbers and titles)</label></label>
            
            <div v-for="(supervised, index) in form.supervisedList" :key="index" class="grid grid-cols-2 gap-4 mb-2">
              <input v-model="supervised.title" placeholder="Position Title" class="w-full border rounded px-3 py-2"/>
              <input v-model="supervised.itemNumber" placeholder="Item Number" class="w-full border rounded px-3 py-2"/>
            </div>
            <button type="button" @click="addSupervisedRow" class="bg-green-500 text-white px-4 py-1 rounded text-sm">+ Add Row</button>
          </div>

          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <label class="block mb-2 font-medium">16. MACHINE, EQUIPMENT, TOOLS, ETC., USED REGULARLY IN PERFOMRNACE OF WORK</label>
            <textarea v-model="form.equipment" rows="3" class="w-full border rounded px-3 py-2"></textarea>
          </div>

          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <h4 class="font-bold mb-3 border-b pb-1">17. CONTACTS / CLIENTS / STAKEHOLDERS</h4>
            
            <p class="font-semibold text-blue-700 text-sm mb-2 uppercase">17a. Internal</p>
            <div class="grid grid-cols-2 gap-4 text-xs mb-4 bg-blue-50 p-2 rounded">
              <div>
                <p class="font-bold mb-1 underline">Occasional</p>
                <label class="block"><input type="checkbox" v-model="form.contactsA.occasional.managerial"/> Executive/Managerial Supervisors</label>
                <label class="block"><input type="checkbox" v-model="form.contactsA.occasional.nonSupervisory"/> Non-Supervisors</label>
                <label class="block"><input type="checkbox" v-model="form.contactsA.occasional.staff"/> Staff</label>
              </div>
              <div>
                <p class="font-bold mb-1 underline">Frequent</p>
                <label class="block"><input type="checkbox" v-model="form.contactsA.frequent.managerial"/> Executive/Managerial Supervisors</label>
                <label class="block"><input type="checkbox" v-model="form.contactsA.frequent.nonSupervisory"/>Non-Supervisors</label>
                <label class="block"><input type="checkbox" v-model="form.contactsA.frequent.staff"/>Staff</label>
              </div>
            </div>

            <p class="font-semibold text-green-700 text-sm mb-2 uppercase">17b. External</p>
            <div class="grid grid-cols-2 gap-4 text-xs bg-green-50 p-2 rounded">
              <div>
                <p class="font-bold mb-1 underline">Occasional</p>
                <label class="block"><input type="checkbox" v-model="form.contactsB.occasional.generalPublic"/> General Public</label>
                <label class="block"><input type="checkbox" v-model="form.contactsB.occasional.otherAgencies"/> Other Agencies</label>
                <label class="block"><input type="checkbox" v-model="form.contactsB.occasional.others"/> Others</label>
                <input v-if="form.contactsB.occasional.others" v-model="form.contactsB.occasional.othersSpecify" placeholder="Specify" class="w-full border rounded px-1 mt-1"/>
              </div>
              <div>
                <p class="font-bold mb-1 underline">Frequent</p>
                <label class="block"><input type="checkbox" v-model="form.contactsB.frequent.generalPublic"/> General Public</label>
                <label class="block"><input type="checkbox" v-model="form.contactsB.frequent.otherAgencies"/> Other Agencies</label>
                <label class="block"><input type="checkbox" v-model="form.contactsB.frequent.others"/> Others</label>
                <input v-if="form.contactsB.frequent.others" v-model="form.contactsB.frequent.othersSpecify" placeholder="Specify" class="w-full border rounded px-1 mt-1"/>
              </div>
            </div>
          </div>

          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <label class="block mb-2 font-medium">18. WORKING CONDITION</label>
            <div class="flex gap-4 mb-2">
              <label><input type="checkbox" v-model="form.workingCondition.officeWork"/> Office Work</label>
              <label><input type="checkbox" v-model="form.workingCondition.fieldWork"/> Field Work</label>
              <label><input type="checkbox" v-model="form.workingCondition.others"/> Others</label>
            </div>
            <div v-if="form.workingCondition.others">
              <label class="text-xs font-bold text-gray-500">Please Specify Other Condition:</label>
              <input v-model="form.workingCondition.othersSpecify" placeholder="Describe condition" class="w-full border rounded px-3 py-2 mt-1"/>
            </div>
          </div>

          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <label class="block mb-2 font-medium">19. BRIEF DESCRIPTION OF THE GENERAL FUNCTION OF THE UNIT OR SECTION</label>
            <textarea v-model="form.unitFunction" rows="2" class="w-full border rounded px-3 py-2 mb-4"></textarea>
            <label class="block mb-2 font-medium">20. BRIEF DESCRIPTION OF THE GENERAL FUNCTION OF THE POSITION (JOB SUMMARY)</label>
            <textarea v-model="form.jobSummary" rows="2" class="w-full border rounded px-3 py-2"></textarea>
          </div>

          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <h4 class="font-semibold mb-3">21. QUALIFICATION STANDARD</h4>

            <!-- 21a -->
            <div>
              <label class="font-medium text-xs">21a. Education</label>
              <div v-for="(item, i) in form.educationList" :key="i" class="mb-2">
                <input v-model="form.educationList[i]" class="w-full border rounded px-3 py-2"/>
              </div>
              <button @click="form.educationList.push('')" type="button" class="text-xs text-blue-600 mb-3">
                + Add Education
              </button>
            </div>

            <!-- 21b -->

            <div>
              <label class="font-medium text-xs">21b. Experience</label>
              <div v-for="(item, i) in form.experienceList" :key="i" class="mb-2">
                <input v-model="form.experienceList[i]" class="w-full border rounded px-3 py-2"/>
              </div>
              <button @click="form.experienceList.push('')" type="button" class="text-xs text-blue-600 mb-3">
                + Add Experience
              </button>
            </div>

            <!-- 21c -->
            <div>
              <label class="font-medium text-xs">21c. Training</label>
              <div v-for="(item, i) in form.trainingList" :key="i" class="mb-2">
                <input v-model="form.trainingList[i]" class="w-full border rounded px-3 py-2"/>
              </div>
              <button @click="form.trainingList.push('')" type="button" class="text-xs text-blue-600 mb-3">
                + Add Training
              </button>
            </div>

            <!-- 21d -->
            <div>
              <label class="font-medium text-xs">21d. Eligibility</label>
              <div v-for="(item, i) in form.eligibilityList" :key="i" class="mb-2">
                <input v-model="form.eligibilityList[i]" class="w-full border rounded px-3 py-2"/>
              </div>
              <button @click="form.eligibilityList.push('')" type="button" class="text-xs text-blue-600 mb-4">
                + Add Eligibility
              </button>
            </div>

            <!-- 21e -->
            <div class="mb-4">
              <label class="font-medium text-xs">21e. Core Competencies</label>

              <div
                v-for="(row, i) in form.coreCompetenciesList"
                :key="i"
                class="grid grid-cols-2 gap-2 mb-2"
              >
                <input
                  v-model="row.competency"
                  placeholder="Core Competency"
                  class="border rounded px-3 py-2 text-sm"
                />
                <input
                  v-model="row.level"
                  placeholder="Competency Level"
                  class="border rounded px-3 py-2 text-sm"
                />
              </div>

              <button
                type="button"
                @click="addCoreCompetency"
                class="text-xs text-blue-600"
              >
                + Add Core Competency
              </button>
            </div>


            <!-- 21f -->
            <div>
              <label class="font-medium text-xs">21f. Leadership Competencies</label>

              <div
                v-for="(row, i) in form.leadershipCompetenciesList"
                :key="i"
                class="grid grid-cols-2 gap-2 mb-2"
              >
                <input
                  v-model="row.competency"
                  placeholder="Leadership Competency"
                  class="border rounded px-3 py-2 text-sm"
                />
                <input
                  v-model="row.level"
                  placeholder="Competency Level"
                  class="border rounded px-3 py-2 text-sm"
                />
              </div>

              <button
                type="button"
                @click="addLeadershipCompetency"
                class="text-xs text-blue-600"
              >
                + Add Leadership Competency
              </button>
            </div>
          </div>


          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <label class="font-semibold block mb-2">
              22. STATEMENT OF DUTIES AND RESPONSIBILITIES
              <span class="text-sm">(Technical Competencies)</span>
            </label>

            <div
              v-for="(row, index) in form.dutiesList"
              :key="index"
              class="grid grid-cols-3 gap-2 mb-2"
            >
              <input
                v-model="row.duty"
                placeholder="Duty / Responsibility"
                class="border rounded px-2 py-2 text-xs"
              />
              <input
                v-model="row.percentage"
                type="number"
                placeholder="% of Working Time"
                class="border rounded px-2 py-2 text-xs"
              />
              <input
                v-model="row.competencyLevel"
                placeholder="Competency Level"
                class="border rounded px-2 py-2 text-xs"
              />
            </div>

            <button
              type="button"
              @click="addDutyRow"
              class="bg-green-500 text-white px-4 py-1 rounded text-sm">
              + Add Row
            </button>
          </div>


          <div class="border p-4 rounded-lg shadow-sm bg-white">
            <h4 class="font-semibold mb-3">23. ACKNOWLEDGEMENT AND ACCEPTANCE</h4>
            <div class="grid grid-cols-2 gap-6">
              <div class="space-y-2">
                <label class="block text-xs font-bold">Employee Name & Signature</label>
                <input v-model="form.employeeName" placeholder="Full Name" class="w-full border rounded px-3 py-2"/>
                <label class="block text-xs font-bold">Date</label>
                <input type="date" v-model="form.employeeDate" class="w-full border rounded px-3 py-2"/>
              </div>
              <div class="space-y-2">
                <label class="block text-xs font-bold">Supervisor Name & Signature</label>
                <input v-model="form.supervisorName" placeholder="Full Name" class="w-full border rounded px-3 py-2"/>
                <label class="block text-xs font-bold">Date</label>
                <input type="date" v-model="form.supervisorDate" class="w-full border rounded px-3 py-2"/>
              </div>
            </div>
          </div>

          <div class="sticky bottom-0 bg-white py-4 border-t flex gap-2">
            <button type="button" @click="updatePreview" :disabled="isLoading" class="flex-1 bg-gray-800 text-white font-bold py-3 rounded-lg hover:bg-black transition">
              {{ isLoading ? 'Processing...' : 'Update Preview' }}
            </button>
            <button type="button" @click="downloadPDF" :disabled="isLoading" class="flex-1 bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
              Download PDF
            </button>
          </div>
        </form>
      </div>

      <div class="lg:w-1/2 bg-gray-300 rounded-xl overflow-hidden shadow-inner h-[90vh] flex items-center justify-center relative">
        <iframe v-if="pdfPreviewUrl" :src="pdfPreviewUrl" class="w-full h-full border-none"></iframe>
        <div v-else class="text-gray-500 font-medium">Click Update Preview to display PDF</div>
      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      pdfPreviewUrl: null,
      isLoading: false,
      form: {
        positionTitle:'', salaryGrade:'',
        lgProvince:false, lgCity:false, lgMunicipality:false,
        class1:false,class2:false,class3:false,class4:false,class5:false,class6:false,classSpecial:false,
        department:'', bureau:'', branch:'', workstation:'',
        presentAppropriation:'', previousAppropriation:'', salaryAuthorized:'', otherCompensation:'',
        immediateSupervisor:'', nextSupervisor:'', 
        supervisedList: [ { title: '', itemNumber: '' } ], 
        equipment:'', 
        contactsA:{occasional:{managerial:false, nonSupervisory:false, staff:false}, frequent:{managerial:false, nonSupervisory:false, staff:false}},
        contactsB:{occasional:{generalPublic:false, otherAgencies:false, others:false, othersSpecify:''}, frequent:{generalPublic:false, otherAgencies:false, others:false, othersSpecify:''}},
        workingCondition:{officeWork:false, fieldWork:false, others:false, othersSpecify:''},
        unitFunction:'', jobSummary:'',
        educationList: [''], experienceList: [''], trainingList: [''], eligibilityList: [''],
        coreCompetenciesList: [{ competency: '', level: '' }],
        leadershipCompetenciesList: [ { competency: '', level: '' }],
        dutiesList: [{ duty: '', percentage: '', competencyLevel: '' }],
        employeeName:'', employeeDate:'', supervisorName:'', supervisorDate:''
      }
    }
  },
  methods: {

    addDutyRow() {
      this.form.dutiesList.push({
        duty: '',
        percentage: '',
        competencyLevel: ''
      });
    },

    addCoreCompetency() {
      this.form.coreCompetenciesList.push({
        competency: '',
        level: ''
      });
    },

    addLeadershipCompetency() {
      this.form.leadershipCompetenciesList.push({
        competency: '',
        level: ''
      });
    },

    addSupervisedRow() { this.form.supervisedList.push({ title: '', itemNumber: '' }); },
    async updatePreview() {
      this.isLoading = true;
      try {
        const res = await axios.post('http://localhost:8080/pdf/generate', this.form, { responseType: 'blob' });
        if (this.pdfPreviewUrl) window.URL.revokeObjectURL(this.pdfPreviewUrl);
        this.pdfPreviewUrl = window.URL.createObjectURL(new Blob([res.data], { type: 'application/pdf' })) + '#view=FitH';
      } catch (err) { alert('Backend error'); } finally { this.isLoading = false; }
    },
    async downloadPDF() {
      this.isLoading = true;
      try {
        const res = await axios.post('http://localhost:8080/pdf/generate', this.form, { responseType: 'blob' });
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(new Blob([res.data]));
        link.download = `Form1_${this.form.positionTitle || 'Export'}.pdf`;
        link.click();
      } catch (err) { alert('Download error'); } finally { this.isLoading = false; }
    }
  }
}
</script>