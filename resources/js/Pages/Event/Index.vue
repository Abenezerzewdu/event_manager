<template>
  <div class="min-h-screen p-6 bg-gray-50">
    <!-- Navigation -->
    <nav class="mb-6 text-white bg-blue-800 shadow-lg">
      <div class="container flex items-center justify-between px-6 py-3 mx-auto">
        <div class="flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <span class="text-xl font-semibold tracking-tight">Event Manager</span>
        </div>
        <div class="flex space-x-4">
          <a href="#" @click="currentView = 'index'" class="px-3 py-2 text-sm font-medium rounded-md hover:bg-blue-700">All Events</a>
          <a href="#" @click="currentView = 'create'" class="px-3 py-2 text-sm font-medium rounded-md hover:bg-blue-700">Create Event</a>
        </div>
      </div>
    </nav>

    <!-- Index View -->
    <div v-if="currentView === 'index'">
      <div class="flex items-center justify-between mb-6">
        <div>
          <h1 class="text-3xl font-bold text-blue-800">Events Management</h1>
          <p class="mt-2 text-blue-600">Manage all your events in one place</p>
        </div>
        <button @click="currentView = 'create'" class="flex items-center px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Create New Event
        </button>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
        <div class="p-6 bg-white rounded-lg shadow-md">
          <div class="flex items-center">
            <div class="p-3 mr-4 text-blue-600 bg-blue-100 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-gray-800">{{ events.length }}</h3>
              <p class="text-gray-600">Total Events</p>
            </div>
          </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-md">
          <div class="flex items-center">
            <div class="p-3 mr-4 text-green-600 bg-green-100 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-gray-800">{{ upcomingEventsCount }}</h3>
              <p class="text-gray-600">Upcoming Events</p>
            </div>
          </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-md">
          <div class="flex items-center">
            <div class="p-3 mr-4 text-purple-600 bg-purple-100 rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <h3 class="text-2xl font-bold text-gray-800">${{ totalBudget }}</h3>
              <p class="text-gray-600">Total Budget</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Events Table -->
      <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
          <h2 class="text-xl font-semibold text-blue-800">All Events</h2>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Event</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Date & Location</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Budget</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Organizer</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="event in events" :key="event.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ event.title }}</div>
                      <div class="text-sm text-gray-500">{{ event.event_type }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ formatDate(event.event_date) }}</div>
                  <div class="text-sm text-gray-500">{{ event.location }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                    ${{ event.budget }}
                  </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                  {{ event.organizer }}
                </td>
                <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                  <div class="flex space-x-2">
                    <button @click="showEvent(event)" class="p-1 text-blue-600 rounded-full hover:text-blue-900 hover:bg-blue-100" title="View">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                      </svg>
                    </button>
                    <button @click="editEvent(event)" class="p-1 text-indigo-600 rounded-full hover:text-indigo-900 hover:bg-indigo-100" title="Edit">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </button>
                    <button @click="deleteEvent(event)" class="p-1 text-red-600 rounded-full hover:text-red-900 hover:bg-red-100" title="Delete">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Create View -->
    <div v-if="currentView === 'create'">
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-blue-800">Create New Event</h1>
        <!-- <button @click="currentView = 'index'" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600">
          Back to Events
        </button> -->
      </div>

      <div class="p-6 bg-white rounded-lg shadow-md">
        <form @submit.prevent="submitForm">
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
              <input type="text" id="title" v-model="form.title" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="event_type" class="block text-sm font-medium text-gray-700">Event Type</label>
              <select id="event_type" v-model="form.event_type_id" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select Event Type</option>
                <option v-for="type in eventTypes" :key="type.id" :value="type.id">{{ type.name }}</option>
              </select>
            </div>
            <div>
              <label for="event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
              <input type="date" id="event_date" v-model="form.event_date" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
              <input type="text" id="location" v-model="form.location" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="budget" class="block text-sm font-medium text-gray-700">Budget ($)</label>
              <input type="number" id="budget" v-model="form.budget" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="is_planned" class="block text-sm font-medium text-gray-700">Status</label>
              <select id="is_planned" v-model="form.is_planned" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option :value="true">Planned</option>
                <option :value="false">Completed</option>
              </select>
            </div>
            <div class="md:col-span-2">
              <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
              <textarea id="description" v-model="form.description" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
          </div>
          <div class="flex justify-end mt-6">
            <button type="button" @click="currentView = 'index'" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Cancel
            </button>
            <button type="submit" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Save Event
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Show View -->
    <div v-if="currentView === 'show' && currentEvent">
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-blue-800">Event Details</h1>
        <!-- <button @click="currentView = 'index'" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600">
          Back to Events
        </button> -->
      </div>

      <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b bg-blue-50">
          <h2 class="text-xl font-semibold text-blue-800">{{ currentEvent.title }}</h2>
        </div>
        <div class="grid grid-cols-1 gap-6 px-6 py-4 md:grid-cols-2">
          <div>
            <h3 class="text-sm font-medium text-gray-500">Event Type</h3>
            <p class="mt-1 text-sm text-gray-900">{{ currentEvent.event_type }}</p>
          </div>
          <div>
            <h3 class="text-sm font-medium text-gray-500">Date</h3>
            <p class="mt-1 text-sm text-gray-900">{{ formatDate(currentEvent.event_date) }}</p>
          </div>
          <div>
            <h3 class="text-sm font-medium text-gray-500">Location</h3>
            <p class="mt-1 text-sm text-gray-900">{{ currentEvent.location }}</p>
          </div>
          <div>
            <h3 class="text-sm font-medium text-gray-500">Budget</h3>
            <p class="mt-1 text-sm text-gray-900">${{ currentEvent.budget }}</p>
          </div>
          <div>
            <h3 class="text-sm font-medium text-gray-500">Status</h3>
            <p class="mt-1 text-sm text-gray-900">
              <span v-if="currentEvent.is_planned" class="inline-flex px-2 text-xs font-semibold leading-5 text-blue-800 bg-blue-100 rounded-full">Planned</span>
              <span v-else class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Completed</span>
            </p>
          </div>
          <div>
            <h3 class="text-sm font-medium text-gray-500">Organizer</h3>
            <p class="mt-1 text-sm text-gray-900">{{ currentEvent.organizer }}</p>
          </div>
          <div class="md:col-span-2">
            <h3 class="text-sm font-medium text-gray-500">Description</h3>
            <p class="mt-1 text-sm text-gray-900">{{ currentEvent.description }}</p>
          </div>
        </div>
        <div class="flex justify-end px-6 py-4 border-t bg-gray-50">
          <button @click="editEvent(currentEvent)" class="px-4 py-2 mr-3 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
            Edit Event
          </button>
          <button @click="currentView = 'index'" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600">
            Back to List
          </button>
        </div>
      </div>
    </div>

    <!-- Edit View -->
    <div v-if="currentView === 'edit' && currentEvent">
      <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-blue-800">Edit Event</h1>
        <!-- <button @click="currentView = 'index'" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600">
          Back to Events
        </button> -->
      </div>

      <div class="p-6 bg-white rounded-lg shadow-md">
        <form @submit.prevent="updateEvent">
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
              <label for="edit_title" class="block text-sm font-medium text-gray-700">Event Title</label>
              <input type="text" id="edit_title" v-model="currentEvent.title" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="edit_event_type" class="block text-sm font-medium text-gray-700">Event Type</label>
              <select id="edit_event_type" v-model="currentEvent.event_type_id" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option v-for="type in eventTypes" :key="type.id" :value="type.id">{{ type.name }}</option>
              </select>
            </div>
            <div>
              <label for="edit_event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
              <input type="date" id="edit_event_date" v-model="currentEvent.event_date" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="edit_location" class="block text-sm font-medium text-gray-700">Location</label>
              <input type="text" id="edit_location" v-model="currentEvent.location" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="edit_budget" class="block text-sm font-medium text-gray-700">Budget ($)</label>
              <input type="number" id="edit_budget" v-model="currentEvent.budget" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
              <label for="edit_is_planned" class="block text-sm font-medium text-gray-700">Status</label>
              <select id="edit_is_planned" v-model="currentEvent.is_planned" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option :value="true">Planned</option>
                <option :value="false">Completed</option>
              </select>
            </div>
            <div class="md:col-span-2">
              <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
              <textarea id="edit_description" v-model="currentEvent.description" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
          </div>
          <div class="flex justify-end mt-6">
            <button type="button" @click="currentView = 'index'" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Cancel
            </button>
            <button type="submit" class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Update Event
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'EventManagement',
  props: {
    events: Array,
    eventTypes: Array
  },
  data() {
    return {
      currentView: 'index',
      events: [
        {
          id: 1,
          title: '',
          event_type: '',
          event_type_id: 1,
          event_date: '',
          location: '',
          budget: 5000,
          is_planned: true,
          description: '',
          organizer: ''
        },
        {
          id: 2,
          title: '',
          event_type: '',
          event_type_id: 2,
          event_date: '',
          location: '',
          budget: 3000,
          is_planned: false,
          description: '',
          organizer: ''
        }
      ],
      eventTypes: [
        { id: 1, name: '' },
        { id: 2, name: '' },
        { id: 3, name: '' },
        { id: 4, name: '' },
        { id: 5, name: '' }
      ],
      currentEvent: null,
      form: {
        title: '',
        event_type_id: '',
        event_date: '',
        location: '',
        budget: 0,
        is_planned: true,
        description: ''
      },
      errors: {} // store validation errors
    }
  },
  computed: {
    upcomingEventsCount() {
      const today = new Date();
      today.setHours(0,0,0,0);
      return this.events.filter(event => new Date(event.event_date) >= today).length;
    },
    totalBudget() {
      return this.events.reduce((total, event) => total + parseFloat(event.budget), 0);
    }
  },
  methods: {
    formatDate(dateString) {
      const regex = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;
      if (!regex.test(dateString)) {
        return "Invalid date";
      }

      const date = new Date(dateString);
      if (isNaN(date)) {
        return "Invalid date";
      }

      const today = new Date();
      today.setHours(0, 0, 0, 0);
      if (date < today) {
        return "Date cannot be in the past";
      }

      const options = { year: "numeric", month: "long", day: "numeric" };
      return date.toLocaleDateString(undefined, options);
    },

    validateForm(formData) {
      this.errors = {};
      let valid = true;

      if (!formData.title) {
        this.errors.title = "Title is required";
        valid = false;
      }

      if (!formData.event_type_id) {
        this.errors.event_type_id = "Event type is required";
        valid = false;
      }

      if (!formData.event_date) {
        this.errors.event_date = "Event date is required";
        valid = false;
      } else {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const chosen = new Date(formData.event_date);
        if (chosen < today) {
          this.errors.event_date = "Event date cannot be in the past";
          valid = false;
        }
      }

      return valid;
    },

    showEvent(event) {
      this.currentEvent = event;
      this.currentView = 'show';
    },
    editEvent(event) {
      this.currentEvent = { ...event
        // event_type: this.eventTypes.find(t => t.id == this.form.event_type_id)?.name || '',
};
      this.currentView = 'edit';
    },
    deleteEvent(event) {
      if (confirm('Are you sure you want to delete this event?')) {
        this.events = this.events.filter(e => e.id !== event.id);
      }
    },
    submitForm() {
      if (!this.validateForm(this.form)) {
        return; 
      }

      const newEvent = {
        id: this.events.length + 1,
        title: this.form.title,
        event_type: this.eventTypes.find(t => t.id == this.form.event_type_id)?.name || '',
        event_type_id: this.form.event_type_id,
        event_date: this.form.event_date,
        location: this.form.location,
        budget: parseFloat(this.form.budget),
        is_planned: this.form.is_planned,
        description: this.form.description,
        organizer: 'Current User'
      };

      this.events.push(newEvent);
      this.resetForm();
        this.successMessage = "Event created successfully!";

      this.currentView = 'index';
        this.currentEvent = newEvent;

    },
    updateEvent() {
      if (!this.validateForm(this.currentEvent)) {
        return;
      }

      const index = this.events.findIndex(e => e.id === this.currentEvent.id);
      if (index !== -1) {
        this.events[index] = { ...this.currentEvent };
            this.successMessage = "Event updated successfully!";

        this.currentView = 'show';
      }
    },
    resetForm() {
      this.form = {
        title: '',
        event_type_id: '',
        event_date: '',
        location: '',
        budget: 0,
        is_planned: true,
        description: ''
      };
      this.errors = {};
    }
  }
}
</script>


