<template>
    <div>
    <table class="table table-hover table-sm">
        <thead>
        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created at</th>
            <th><button type="button" class="btn btn-default pull-right btn-sm" @click="showAddArticle()">
                    Add Article
                </button>
            </th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="article in articles" v-bind:key="article.id">
                <td>{{ article.id }}</td>
                <td>{{ article.title }}</td>
                <td>{{ article.body }}</td>
                <td>{{ article.created_at }}</td>
                <td class="text-right">
                    <button @click="editArticle(article)" class="btn btn-default btn-sm">Edit</button>
                    <button @click="ConfirmDelete(article.id)" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.prev_page_url)">Previous</a></li>

        <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
    
        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
      </ul>
    </nav>
  
    <div class="modal fade" id="modal-article">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Article {{ edit?'Edit':'Add'}}</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form @submit.prevent="addArticle" class="mb-3">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Title" v-model="article.title" required>
              </div>
              <div class="form-group">
                  <textarea class="form-control" placeholder="Body" v-model="article.body" required></textarea>
              </div>
              <button type="submit" class="btn btn-light btn-block">Save</button>
              </form>
              <button @click="clearForm()" class="btn btn-danger btn-block">Cancel</button>
          </div>
          </div>
          <!-- /.modal-content -->
      </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-------------- Modal Delete ------------------>
    <div id="showDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash" aria-hidden="true"></i> Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure to delete <span class="delete_title"></span>?
                <input type="hidden" id="deleteid">
            </div>
            <div class="modal-footer">
                <button @click="DeleteItem()" type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
            </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      articles: [],
      article: {
        id: '',
        title: '',
        body: ''
      },
      article_id: '',
      pagination: {},
      edit: false,
      api_token: this.$root.api_token
    };
  },
  created() {
    this.fetchArticles();
  },
  methods: {
    fetchArticles(page_url) {
      let vm = this;
      var url = '';
      url = (page_url? page_url+'&':'/api/articles?');
      fetch(url+'api_token='+vm.api_token)
        .then(res => res.json())
        .then(res => {
          this.articles = res.data;
          vm.makePagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makePagination(meta, links) {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };
      this.pagination = pagination;
    },
    ConfirmDelete(id){
        $('.delete_title').html('Article #<b>'+ id +'</b>');
        $('#showDelete').modal('show');
        $("#deleteid").val(id);
    },
    DeleteItem() {
        let vm = this;
        var id = $("#deleteid").val();
        fetch('/api/article/'+id+'?api_token='+vm.api_token, {
            method: 'delete'
        })
        .then(res => res.json())
        .then(data => {
            this.fetchArticles();
            toastr.success('Article Removed.');
        })
        .catch(err => console.log(err));
    },
    addArticle() {
      let vm = this;
      if (this.edit === false) {
        // Add
        fetch('/api/article?api_token='+vm.api_token, {
          method: 'post',
          body: JSON.stringify(this.article),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            $('#modal-article').modal('hide');
            toastr.success('Article Added.');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('/api/article?api_token='+vm.api_token, {
          method: 'put',
          body: JSON.stringify(this.article),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            $('#modal-article').modal('hide');
            toastr.success('Article Updated.');
            this.fetchArticles();
          })
          .catch(err => console.log(err));
      }
    },
    showAddArticle() {
        this.edit = false;
        this.article.id = null;
        this.article.article_id = null;
        this.article.title = '';
        this.article.body = '';
        $("#modal-article").modal();
    },
    editArticle(article) {
      this.edit = true;
      this.article.id = article.id;
      this.article.article_id = article.id;
      this.article.title = article.title;
      this.article.body = article.body;
      $("#modal-article").modal();
    },
    clearForm() {
      this.edit = false;
      this.article.id = null;
      this.article.article_id = null;
      this.article.title = '';
      this.article.body = '';
    }
  }
};
</script>

