import { registerBlockType } from "@wordpress/blocks"
import { useBlockProps } from "@wordpress/block-editor"
import metadata from "./block.json"

function Edit() {
    const blockProps = useBlockProps()

    return <div {...blockProps}>
        <div className="placeholder-block">footer block</div>
    </div>
}

registerBlockType(metadata.name, {
  edit: Edit
})