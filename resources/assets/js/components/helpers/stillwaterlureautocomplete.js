import algolia from 'algoliasearch'
import autocomplete from 'autocomplete.js'

var index = algolia('2MAPXHHGIZ', '3b6801b29d697fc6021a7cfd3b62ed72')

export const stillwaterlureautocomplete = (selector, ) => {
	index = index.initIndex('district_stillwater_lures')

	return autocomplete('#districts', {}, {
		source: autocomplete.sources.hits(index, { hitsPerPage: 4 }),
		displayKey: 'name',
		templates: {
			suggestion (suggestion) {
				return '<span>' + suggestion.name + '</span>'
			},
			empty: '<div class="aa=empty">No Stillwaterlures Found</div>'
		}
	})
}