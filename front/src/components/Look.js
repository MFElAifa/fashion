import React from "react";
import Message from "./Message";
import { canWriteLookBrand } from "../apiUtils";

export default class Look extends React.Component{
    render(){
        const {post, userData} = this.props;
        
        if(null === post){
            return (<Message message="Look does not exist" />);
        } 
        
        if(userData === null || !canWriteLookBrand(userData, post.brand)){
            return <Message message="You can't edit this LOOK!" />
        }

        return (
            <div className="card mb3- mt-3 shadow-sm">
                <div className="card-body">
                    <h2>Edit LOOK!</h2>
                </div>
            </div>
        );
    }
}