<template>
  <div class="relative mx-auto mt-16 grid w-full max-w-container grid-cols-1 px-4 sm:mt-20 sm:px-6 lg:px-8 xl:mt-32">
    <div class="card">
        <div class="mb-5 flex justify-between">
          <div>
            <div class="flex flex-col gap-2">
              <label for="storeData">&nbsp;</label>
              <Button id="storeData" label="Add Post" @click="storeData"/>
            </div>
          </div>
          <div class="flex justify-end gap-2">
            <div class="flex flex-col gap-2">
              <label for="createdAt">Дата создания</label>
              <Select id="createdAt" v-model="createdAt" :options="sortSelect" @change="pageUpdate(null)" optionLabel="title" placeholder="Дата создания" class="w-full md:w-56" />
              
            </div>            
            <div class="flex flex-col gap-2">
              <label for="price">Цена</label>
              <Select id="price" v-model="price" :options="sortSelect" @change="pageUpdate(null)" optionLabel="title" placeholder="Цена" class="w-full md:w-56" />
            </div>            
          </div>         
        </div>
        <DataTable 
          :value="currentPosts"
          @page="pageUpdate"
          paginator 
          :rows="10"
          :totalRecords="totalPosts"
          lazy
          tableStyle="min-width: 50rem"
        >
            <Column field="name" header="Name" style="width: 25%"></Column>
            <Column field="url1" header="Url 1" style="width: 40%"></Column>
            <Column field="price" header="Price" style="width: 25%"></Column>
            <Column  header="Watch" style="width: 10%">
              <template #body="{data}">
                <Button label="watch" @click="showData(data)" />
              </template>
            </Column>
        </DataTable>
      </div>
      <DynamicDialog />
    </div>
</template>

<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional
import { markRaw, defineAsyncComponent } from 'vue';
import DynamicDialog from 'primevue/dynamicdialog';
import { useDialog } from 'primevue/usedialog';
import Select from 'primevue/select';
import { useToast } from 'primevue/usetoast';
import { ref, onMounted } from 'vue';
import { Services } from './services';

const ShowPost = defineAsyncComponent(() => import('./components/ShowPost.vue'));
const AddPost = defineAsyncComponent(() => import('./components/AddPost.vue'));
const dialog = useDialog();

onMounted(() => {
    (indexData.service)();
});

const currentPosts = ref();
const totalPosts = ref();

const createdAt = ref(null)
const price = ref(null);
const sortSelect = ref([
  {id: 'asc', title: 'Убывание'},
  {id: 'desc', title: 'Возрастание'},
  {id: null, title: 'Пусто'},
])

const pageUpdate = (v = null) => {
  (indexData.service)(v)
}

const indexData = {
    data: {
      page: 1, // 1 - ...
      created_at: null, // asc, desc
      price: null, // asc, desc      
    },
    service(v = null) {

      this.data.created_at = createdAt.value?.id
      this.data.price = price.value?.id


      const filterData = !v ? this.data :
        Object.assign(this.data, {page: v?.page + 1})      

      Services.PostsService(filterData)
      .then((data) => {
        currentPosts.value = data.data.data
        totalPosts.value = data.data.total
      })
    }

}

const storeData = () => {
  dialog.open(AddPost, {
        props: {
            header: 'Add Post',
            style: {
                width: '30vw',
            },
            breakpoints:{
                '960px': '35vw',
                '640px': '40vw'
            },
            modal: true
        },
        onClose: (options) => {
          
        },
        emits: {
            onSave: () => {            
              (indexData.service)()
            } 
        }

        
    });  
}

const showData = (v) => {

  const id = v.id;

  Services.ShowService(id)
    .then(response => {

      dialog.open(ShowPost, {
            props: {
                header: 'Показать пост',
                style: {
                    width: '30vw',
                },
                breakpoints:{
                    '960px': '35vw',
                    '640px': '40vw'
                },
                modal: true
            },
            data: {
              data: response,
    
            },
            onClose: (options) => {
                // const data = options.data;
            }
      });
    })
    .catch(error => console.log(error));
  
}

</script>
