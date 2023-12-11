import {useEffect, useState} from 'react';
import './estate-list.css';

export type Categories = {
    id: number;
    name: string;
};

export type Estate = {
    id: number;
    city?: string;
    name?: string;
    zip?: string;
    address?: string;
    category: {
        id: number;
    };
    subCategory: {
        id: number;
    };
    purpose: {
        id: number;
    };
    pictures?: {
        urlLarge?: string;
        urlSmall?: string;
        urlXXL?: string;
    }[];
    sms?: {
        languageId: string;
        content: string;
    }[];
}

const EstateList = () => {
    const [estates, setEstates] = useState<Estate[]>([]);
    const [categories, setCategories] = useState<Categories[]>([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {


        const getEstates = async () => {
            try {
                const response = await fetch('http://localhost:1234/api/estates.php');
                const result = await response.json();
                setEstates(result as Estate[]);
            } catch (error) {
                console.error('Error fetching data:', error);
                setLoading(false);
            }
        };

        const getCategories = async () => {
                try {
                    const response = await fetch('https://api.whise.eu/reference?item=category&lang=en-GB');
                    const result = await response.json();
                    setCategories(result as Categories[]);
                } catch (error) {
                    console.error('Error fetching data:', error);
                    setLoading(false);
                }
        }

        const fetchAll = async() => {
            await getCategories();
            await getEstates();
            setLoading(false);
        }

        fetchAll();

    }, []);

    return (
        <div className={'my-4'}>
            <h1>List</h1>
            {loading ? (
                <p>Loading...</p>
            ) : (
                <div className={'estate-list'}>
                    <div className={'row'}>
                        {estates.map((estate, key) => (
                            <div key={key} className={'col-lg-3'}>
                                <div className="card mb-4">
                                    {estate.pictures && estate.pictures.length > 0 ?
                                        <div className={'img-wrap'}>
                                            <img src={estate.pictures[0].urlXXL} className="card-img-top"
                                                 alt={estate.name}/>
                                        </div> : null
                                    }
                                    <div className="card-body">
                                        <h5 className="card-title">{estate.name}</h5>
                                        <div className={'my-3'}>
                                            {estate.purpose.id === 1 ? <span className={'badge bg-info'}>For sale</span> : null}
                                            {estate.purpose.id === 2 ? <span className={'badge bg-info'}>For rent</span> : null}
                                            <span style={{ textTransform: 'capitalize' }} className={'badge bg-primary ms-1'}>{categories.find((category) => category.id === estate.category.id)?.name}</span>
                                        </div>
                                        {estate.sms && estate.sms.length > 0 ? (
                                            <p className="card-text">{estate.sms[0].content}</p>
                                        ) : null}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </div>
    );
};

export default EstateList;