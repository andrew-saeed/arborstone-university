import './index.scss'

import {useSelect} from '@wordpress/data'

wp.blocks.registerBlockType('plugins/featured-professor', {
    title: 'Featured Professor',
    description: 'Include a link to a professor',
    icon: 'welcome-learn-more',
    category: 'common',
    attributes: {
        "professorId": {type: "string"}
    },
    edit(props) {

        const professorsList = useSelect(select => {
            return select('core').getEntityRecords('postType', 'professor', {per_page: -1})
        })

        if(professorsList == undefined) return <h3>Loading Professors List ...</h3>

        return <div className="featured-professor-edit-block">
            <select name="professor-id" id="professor-id" onChange={e => props.setAttributes({professorId: e.target.value})}>
                <option value="">Select Professor</option>
                {
                    professorsList.map(professor => {
                        return <option value={professor.id} selected={props.attributes.professorId == professor.id}>{professor.title.rendered}</option>
                    })
                }
            </select>
        </div>
    },
    save(props) {
        return null
    }
})