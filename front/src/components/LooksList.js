import React from 'react';
import { Link } from 'react-router-dom';
import Message from './Message';
import { canWriteLookBrand } from "../apiUtils";


class LooksList extends React.Component{
    
    render(){
        const {posts, userData} = this.props;
        //console.log(posts);
        //console.log(userData);
        if(null === posts || 0 === posts.length){
            return (<Message message="No Looks" />);
        }

        const linkEdit = (userData, id, brand) => {
            if(canWriteLookBrand(userData, brand)){
                return <Link  to={`/looks/${id}`}> Editer</Link>;
            } else {
                return '';
            }
        }

        return (
            <div className='row'>
                {posts && posts.map(post => (
                    

                    <div className="col-4" key={post.id}>
                        <div className="card mb-3 mt-3 shadow-sm">
                            <div className="card-body">
                                <img src={ post.picture } className="img-fluid" alt="Image du produit"/>
                                <h6 className="card-title">{ post.brand.name } - {post.season.name}</h6>
                                { linkEdit(userData, post.id, post.brand) }
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        );
    }
}

export default LooksList;
