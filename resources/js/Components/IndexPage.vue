<template>
    <div class="index-container">
        <h2 class="text-4xl my-12">{{ showSubscribers ? 'Subscriber Manager' : 'Field Manager' }}</h2>
        <div class="flex justify-around items-center w-full">
            <button :class="showSubscribers ? 'blue-3d-button active' : 'blue-3d-button'" @click="showSubscribers = !showSubscribers" :disabled="showSubscribers">Show Subscribers</button>
            <button :class="!showSubscribers ? 'blue-3d-button active' : 'blue-3d-button'" @click="showSubscribers = !showSubscribers" :disabled="!showSubscribers">Show Fields</button>
        </div>
        <div class="table-container">
            <div class="table-responsive">
                <table class="w-full table-fixed table-mobile sm:table" v-if="showSubscribers">
                    <thead class="w-full">
                    <tr class="flex">
                        <th class="px-4 py-2 flex-1-33 w-33">Name</th>
                        <th class="px-4 py-2 flex-1-33 w-33">E-mail</th>
                        <th class="px-4 py-2 flex-1-33 w-33">State</th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr
                        class="bg-gray-100 cursor-pointer flex"
                        v-for="subscriber in this.subscribers"
                        @click="showModalFor('subscriber', subscriber.id)"
                    >
                        <td class="table-body-row flex-1-33 w-33">{{ subscriber.name }}</td>
                        <td class="table-body-row flex-1-33 w-33 break-all">{{ subscriber.email }}</td>
                        <td class="table-body-row flex-1-33 w-33">{{ subscriber.state }}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="w-full table-auto" v-else>
                    <thead>
                    <tr>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Type</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 font-bold text-center">
                    <tr
                        class="bg-gray-100 cursor-pointer"
                        v-for="field in this.fields"
                        @click="showModalFor('field', field.id)"
                    >
                        <td class="table-body-row">{{ field.title }}</td>
                        <td class="table-body-row">{{ field.type }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-8 w-full flex justify-end">
                <button class="blue-3d-button" @click="showModalFor(showSubscribers ? 'subscriber' : 'field')">Add new...</button>
            </div>
        </div>
    </div>
    <Teleport to="body">
        <modal :show="showModal" @close="closeModal()">
            <template #header>
                <h3>{{ this.modalData.name }}</h3>
            </template>
            <template #body v-if="modalData.subscriber">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form action="#" method="POST">
                        <div class="overflow-hidden shadow sm:rounded-md border">
                            <div class="bg-white p-6">
                                <div class="grid gap-6">
                                    <div class="col-span-6">
                                        <label for="name" class="block font-medium text-gray-700">Name</label>
                                        <input v-model="subscriberForm.name" type="text" name="name" id="name" autocomplete="name" class="input-field" />
                                    </div>
                                    <div class="col-span-6">
                                        <label for="email" class="block font-medium text-gray-700">Email address</label>
                                        <input v-model="subscriberForm.email" type="email" name="email" id="email" autocomplete="email" class="input-field" />
                                    </div>
                                    <div class="col-span-6">
                                        <label for="state" class="block font-medium text-gray-700">State</label>
                                        <select v-model="subscriberForm.state" id="state" name="state" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm-md focus:outline-cyan-500">
                                            <option disabled selected value> -- select an option -- </option>
                                            <option v-for="option in this.stateOptions">{{ option }}</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6">
                                        <label id="fields" class="block font-medium text-gray-700">Fields</label>
                                        <Multiselect
                                            v-model="subscriberForm.fields"
                                            :value-prop="'id'"
                                            :open-direction="subscriberForm.fields.length <= 1 ? 'top' : 'bottom'"
                                            :mode="'multiple'"
                                            :searchable="true"
                                            :label="'title'"
                                            :show-options="true"
                                            :object="true"
                                            :options="fieldOptions"
                                            :no-options-text="'The list is empty.'"
                                        ></Multiselect>
                                        <div class="col-span-6 mt-5" v-for="(field, index) in subscriberForm.fields">
                                            <label :for="field.title" class="block font-medium text-gray-700">{{ field.title }}</label>
                                            <input
                                                v-if="field.type !== 'boolean'"
                                                v-model="subscriberForm.fields[index].value"
                                                :type="field.type === 'string' ? 'text' : field.type" :name="field.title"
                                                :id="field.title"
                                                class="input-field"
                                            />
                                            <select v-else v-model="subscriberForm.fields[index].value" :name="field.title" :id="field.title" class="input-field">
                                                <option disabled selected value> -- select an option -- </option>
                                                <option :value="'true'">Yes</option>
                                                <option :value="'false'">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </template>
            <template #body v-else>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form action="#" method="POST">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid gap-6">
                                    <div class="col-span-6">
                                        <label for="title" class="block font-medium text-gray-700">Title</label>
                                        <input v-model="fieldForm.title" type="text" name="title" id="title" class="input-field" />
                                    </div>
                                    <div class="col-span-6">
                                        <label for="type" class="block font-medium text-gray-700">Type</label>
                                        <select v-model="fieldForm.type" id="type" name="type" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm-md focus:outline-cyan-500">
                                            <option disabled selected value> -- select an option -- </option>
                                            <option v-for="option in this.typeOptions">{{ option }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </template>
            <template #footer>
                <div :class="isEditMode ? 'flex justify-between' : 'flex justify-end'">
                    <button class="red-3d-button mr-3" v-show="isEditMode" @click.prevent="destroy()">Delete</button>
                    <button class="blue-3d-button" type="submit" @click.prevent="submit()">Save</button>
                </div>
            </template>
        </modal>
    </Teleport>
</template>

<script>
import Multiselect from '@vueform/multiselect';
import Repository from '../repository';

export default {
    name: "IndexPage",
    components: {Multiselect},
    props: {
        subscribersData: {
            type: Object,
            default: function () {
                return {};
            }
        },
        fieldsData: {
            type: Object,
            default: function () {
                return {};
            }
        },
        routes: {
            type: Object,
            default: function () {
                return {};
            }
        },
        stateOptions: {
            type: Array,
            default: function () {
                return [];
            }
        },
        typeOptions: {
            type: Array,
            default: function () {
                return [];
            }
        },
    },
    data() {
        return {
            subscribers: this.subscribersData,
            fields: this.fieldsData,
            showSubscribers: true,
            showModal: false,
            modalData: {
                name: null,
                subscriber: null,
                id: null
            },
            subscriberForm: {
                name: null,
                email: null,
                state: null,
                fields: [],
            },
            fieldForm: {
                title: null,
                value: null,
                type: null,
            },
            fieldOptions: this.fieldsData,
            error: false,
        }
    },
    computed: {
        isEditMode() {
            return this.modalData.id !== null;
        }
    },
    methods: {
        async submit() {
            let formData = this.modalData.subscriber ? this.subscriberForm : this.fieldForm;
            if (this.modalData.subscriber) {
                this.subscriberForm.fields.forEach((item) => {
                    if (!item.hasOwnProperty('value')) {
                        item.value = null;
                    }
                });
                formData = this.subscriberForm;
            } else {
                formData = this.fieldForm;
            }
            let routePrefix = this.modalData.subscriber ? 'sub-' : 'field-';
            let submitUrl = this.isEditMode ? this.routes[routePrefix + 'update'].replace('_ID_', this.modalData.id) : this.routes[routePrefix + 'store'];

            if (this.isEditMode) {
                formData['_method'] = 'PUT';
            }

            this.error = typeof await Repository.postWithFullResponse(submitUrl, formData) === 'undefined';
            if (!this.error) {
                await this.update(routePrefix);
                this.closeModal();
            }

        },
        async destroy() {
            let routePrefix = 'field-';
            if (this.modalData.subscriber) {
                routePrefix = 'sub-';
            }

            let submitUrl = this.routes[routePrefix + 'destroy'].replace('_ID_', this.modalData.id);
            this.error = typeof await Repository.postWithFullResponse(submitUrl, {_method: 'DELETE'}) === 'undefined';
            if (!this.error) {
                await this.update(routePrefix);
                this.closeModal();
            }

        },
        async update(routePrefix) {
            let updated = await Repository.get(this.routes[routePrefix + 'index']);
            if (this.modalData.subscriber) {
                this.subscribers = updated.data.data;
            } else {
                this.fields = updated.data.data;
                this.fieldOptions = updated.data.data;
            }
        },
        showModalFor(resource, id) {
            if (resource !== 'subscriber' && resource !== 'field') {
                return;
            }
            let isEditMode = typeof id !== 'undefined';
            this.modalData.subscriber = resource === 'subscriber';
            this.modalData.name = isEditMode ? `Edit ${resource}` : `Create ${resource}`;
            this.modalData.id = isEditMode ? id : null;
            if (isEditMode && this.modalData.subscriber) {
                let subscriber = _.cloneDeep(this.subscribers.find(sub => {
                    return sub.id === this.modalData.id;
                }));
                this.subscriberForm.name = subscriber.name;
                this.subscriberForm.email = subscriber.email;
                this.subscriberForm.state = subscriber.state;
                this.subscriberForm.fields = subscriber.fields;
            } else if (isEditMode && !this.modalData.subscriber) {
                let field = this.fields.find(f => {
                    return f.id === this.modalData.id;
                });
                this.fieldForm.title = field.title;
                this.fieldForm.type = field.type;
            }
            this.showModal = true;
        },
        closeModal() {
            if (this.modalData.subscriber) {
                this.subscriberForm.name = null;
                this.subscriberForm.email = null;
                this.subscriberForm.state = null;
                this.subscriberForm.fields.forEach((field, index) => {
                    this.subscriberForm.fields[index].value = null;
                });
                this.subscriberForm = {
                    name: null,
                    email: null,
                    state: null,
                    fields: [],
                }
            } else {
                this.fieldForm = {
                    title: null,
                    value: null,
                    type: null,
                }
            }

            this.modalData = {
                name: null,
                subscriber: null,
                id: null
            }
            this.showModal = false;
        }
    }
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<style scoped>

</style>
