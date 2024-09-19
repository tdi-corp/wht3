<template>
  <div class="relative mx-auto mt-16 grid w-full max-w-container grid-cols-1 px-4 sm:mt-20 sm:px-6 lg:px-8 xl:mt-32">
    <div class="card">
        <div class="mb-5">
          <Button label="Add Post" @click="storeData"/>
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
import { useToast } from 'primevue/usetoast';
import { ref, onMounted } from 'vue';

const Form = defineAsyncComponent(() => import('./components/Form.vue'));
const AddPost = defineAsyncComponent(() => import('./components/AddPost.vue'));
const dialog = useDialog();

onMounted(() => {
    (indexData.service)();
});

const currentPosts = ref();
const totalPosts = ref();

const pageUpdate = (v) => {
  (indexData.service)(v)
}

const indexData = {
    data: {
      page: 1, // 1 - ...
      created_at: null, // asc, desc
      price: null, // asc, desc      
    },
    service(v = null) {

      const filterData = !v ? this.data :
        Object.assign(this.data, {page: v?.page + 1})

      // console.log(filterData);
      

      PostsService(this.data)
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

  dialog.open(Form, {
        props: {
            header: 'Product List',
            style: {
                width: '50vw',
            },
            breakpoints:{
                '960px': '75vw',
                '640px': '90vw'
            },
            modal: true
        },
        templates: {
            // footer: markRaw(FooterDemo)
        },
        onClose: (options) => {
            // const data = options.data;
        }
  });

  console.log(v.id);
  
}

const PostsService = (params = null) => {
  const queryParams = params
      ? Object.keys(params)
            .map((k) => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
            .join('&')
      : '';

  return fetch('http://localhost:8000/api/post?' + queryParams).then((res) => res.json());
}
</script>
