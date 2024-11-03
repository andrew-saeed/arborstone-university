import './index.scss'

import {useSelect} from '@wordpress/data'
import {useState, useEffect} from 'react'
import apiFetch from '@wordpress/api-fetch'

wp.blocks.registerBlockType('plugins/featured-professor', {
    title: 'Featured Professor',
    description: 'Include a link to a professor',
    icon: 'welcome-learn-more',
    category: 'common',
    attributes: {
        "professorId": {type: "string", default: ""}
    },
    edit(props) {

        const [preview, setPreview] = useState("")

        useEffect(() => {
            if(props.attributes.professorId) {
                updatePostprofessorsMeta()
                const getProfessorHTML = async () => {
                    const professorHTML = await apiFetch({
                        path: `/featuredProfessor/v1/getProfessorItemHTML?id=${props.attributes.professorId}`,
                        method: 'GET'
                    })
                    setPreview(professorHTML)
                }
                getProfessorHTML()
            }
        }, [props.attributes.professorId])

        useEffect(() => {
            return () => {
                updatePostprofessorsMeta()
            }
        }, [])

        const updatePostprofessorsMeta = () => {
            const professorsBlocks = wp.data.select('core/block-editor')
            .getBlocks()
            .filter(block => block.name == 'plugins/featured-professor')
            .map(block => block.attributes.professorId)
            .filter((block, index, arr) => {
                return arr.indexOf(block) == index
            })
            wp.data.dispatch('core/editor').editPost({meta: {featuredProfessor: professorsBlocks}})
        }

        const professorsList = useSelect(select => {
            return select('core').getEntityRecords('postType', 'professor', {per_page: -1})
        })

        if(professorsList == undefined) return <h3>Loading Professors List ...</h3>

        return <div className="featured-professor-edit-block">
            <select name="professor-id" id="professor-id" onChange={e => props.setAttributes({professorId: e.target.value})}>
                <option value="" disabled selected={props.attributes.professorId == ""}>Select Professor</option>
                {
                    professorsList.map(professor => {
                        return <option value={professor.id} selected={props.attributes.professorId == professor.id}>{professor.title.rendered}</option>
                    })
                }
            </select>
            <div dangerouslySetInnerHTML={{__html: preview}}></div>
        </div>
    },
    save(props) {
        return null
    }
})