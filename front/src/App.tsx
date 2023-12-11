import './App.css'
import EstateList from "./components/estates-list/EstateList.tsx";
import Header from "./components/header/Header.tsx";
import Footer from "./components/footer/Footer.tsx";

function App() {
    return (
        <>
            <Header/>
            <div className={'container'}>
                <EstateList/>
            </div>
            <Footer />
        </>
    )
}

export default App
