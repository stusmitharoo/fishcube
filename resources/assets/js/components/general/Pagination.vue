<template>
	<nav aria-label="Page navigation example"class="words col-xs-10 col-xs-offset-1">
	  <ul class="pagination pagination-sm">
	    <li class="page-item" :class="{ 'disabled': meta.current_page === 1 }">
	      <a class="page-link" href="#" aria-label="Previous" @click.prevent="switched(meta.current_page -1)">
	        <span aria-hidden="true">&laquo;</span>
	        <span class="sr-only">Previous</span>
	      </a>
	    </li>
	    <template v-if="section > 1">
	    	<li>
	    		<a href="#" @click.prevent="switched(1)">1</a>
	    	</li>
	    	<li>
	    		<a href="#" @click.prevent="goBackASection">...</a>
	    	</li>
	    </template>
	    <li v-for="page in pages" 
	    	class="page-item"
	    	:class="{ 'active': meta.current_page === page }">
	    	<a class="page-link" href="#" @click.prevent="switched(page)">{{ page }}</a>
	    </li>
	    <template v-if="section < sections">
	    	<li>
	    		<a href="#" @click.prevent="switched(meta.total_pages)">{{ meta.total_pages }}</a>
	    	</li>
	    	<li>
	    		<a href="#" @click.prevent="goForwardASection">...</a>
	    	</li>
	    </template>
	    <li class="page-item" :class="{ 'disabled': meta.current_page === meta.total_pages }">
	      <a class="page-link" href="#" aria-label="Next" @click.prevent="switched(meta.current_page +1)">
	        <span aria-hidden="true">&raquo;</span>
	        <span class="sr-only">Next</span>
	      </a>
	    </li>
	  </ul>
	</nav>
</template>

<script>
	export default {
		props:[
			'meta',
		],

		data() {
			return {
				numbersPerSection: 1,
			}
		},

		computed: {
			section () {
				return Math.ceil(this.meta.current_page / this.numbersPerSection)
			},
			sections() {
				return Math.ceil(this.meta.total_pages / this.numbersPerSection)
			},
			lastPage() {
				let lastPage = ((this.section - 1) * this.numbersPerSection) + this.numbersPerSection

				if(this.section === this.sections) {
					lastPage = this.meta.total_pages
				}

				return lastPage
			},
			pages() {
				return _.range(
					(this.section -1) * this.numbersPerSection + 1,
					this.lastPage + 1
				)
			}
		},

		methods: {
			
			switched(page) {
				if(page <= 0 || page > this.meta.total_pages) {
					return;
				}
				this.$emit('pagination:switched', page)
			},
			goBackASection() {
				this.switched(
					this.firstPageOfSection(this.section - 1)
				)
			},
			goForwardASection() {
				this.switched(
					this.firstPageOfSection(this.section + 1)
				)
			},
			firstPageOfSection(section) {
				return (section - 1) * this.numbersPerSection + 1
			}
		}
	}
</script>