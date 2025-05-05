<!--**
CUSTOM WISHLIST CONTAINER
 *-->
<template>
  <div class="wishlist-container tw-w-full">
    <div class="wishlist-container-header tw-flex tw-items-center tw-justify-between tw-mb-5">
      <h1>{{ title }}</h1>

      <a
        @click="openNewWishlistModal"
        class="wishlist-add-to-new btn-primary"
      >
        <i class="material-icons tw-mr-1 tw-align-middle tw-text-lg">add_circle_outline</i>
        {{ addText }}
      </a>
    </div>

    <section
      id="content"
      class="page-content card card-block tw-p-0 tw-mb-3"
    >
      <list
        :items="lists"
        :rename-text="renameText"
        :share-text="shareText"
        :empty-text="emptyText"
        :loading="$apollo.queries.lists.loading"
      />
    </section>
  </div>
</template>

<script>
  import List from '@components/List/List';
  import getLists from '@graphqlFiles/queries/getlists';
  import EventBus from '@components/EventBus';

  /**
   * This component act as a smart component wich will handle every actions of the list one
   */
  export default {
    name: 'WishlistContainer',
    components: {
      List,
    },
    apollo: {
      lists: {
        query: getLists,
        variables() {
          return {
            url: this.url,
          };
        },
      },
    },
    props: {
      url: {
        type: String,
        required: true,
      },
      title: {
        type: String,
        required: true,
      },
      addText: {
        type: String,
        required: true,
      },
      renameText: {
        type: String,
        required: true,
      },
      emptyText: {
        type: String,
        required: true,
      },
      shareText: {
        type: String,
        required: true,
      },
    },
    data() {
      return {
        lists: [],
      };
    },
    methods: {
      /**
       * Send an event to opoen the Create Wishlist Modal
       */
      openNewWishlistModal() {
        EventBus.$emit('showCreateWishlist');
      },
    },
    mounted() {
      /**
       * Register to the event refetchList so if an other component update it, this one can update his list
       *
       * @param {String} 'refetchList' The event I decided to create to communicate between VueJS Apps
       */
      EventBus.$on('refetchList', () => {
        this.$apollo.queries.lists.refetch();
      });
    },
  };
</script>

<style lang="scss" type="text/scss">
  @import '@scss/_variables';

  body#module-blockwishlist-lists {
    // Styles spécifiques pour la page liste d'envies
    .wishlist {
      &-container {
        &-header {
          display: flex;
          align-items: center;
          justify-content: space-between;
          margin-bottom: 1.25rem;
        }

        @at-root #main & .card.page-content {
          padding: 0;
          margin-bottom: 0.75rem;
        }
      }

      &-add-to-new {
        cursor: pointer;
        transition: 0.2s ease-out;
        font-size: 0.875rem;
        letter-spacing: 0;
        line-height: 1rem;

        &:hover {
          opacity: 0.7;
        }

        i {
          margin-right: 0.3125rem;
          vertical-align: middle;
          margin-top: -0.125rem;
          font-size: 1.25rem;
        }
      }
    }

    @media screen and (max-width: $breakpoint-sm) {
      .wishlist {
        &-container {
          width: 95% !important;
          margin: 0 auto;
          
          .page-content.card {
            box-shadow: 0.125rem 0.125rem 0.5rem 0 rgba(0, 0, 0, 0.2);
            background-color: #fff;
            margin-top: 1.25rem;
            border-radius: 6px;
          }
        }
      }
    }
  }
</style>
